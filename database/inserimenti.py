from faker import Faker
import sys
import subprocess
import random
# faker genera, in automatico, stringhe "casuali" seguendo certi schemi.
fake = Faker('it_IT') # 'en_US'
# Numero di tuple da generare.
size = int(sys.argv[1])

list_users = []

command = 'php'
path = 'C:/path/to/hash.php' # MODIFICARE QUESTO PERCORSO!!!
f = open('popolamento.sql', 'a')
# Prepared statements.
users = 'INSERT INTO user (email, firstname, lastname, pwd) VALUES (\'{email}\', \'{firstname}\', \'{lastname}\', {pwd}); /* la vera password è: {pas} */\n'

for i in range(size):
    # password uniche da 8 caratteri alfanumerici.
    arg = fake.unique.password(8,  special_chars=False)
    # Ci si appoggia alla libreria subprocess per eseguire lo script php invoncandolo tramite shell e 
    # passandogli la password come argomento.
    proc = subprocess.Popen([command, path, arg], shell=True, stdout=subprocess.PIPE)
    # Passaggio di pulizia della stringa NECESSARIO. Va a rimuovere il carattere 'b' all'inizio della stringa.
    # Si fa il cast a lista perchè le stringhe sono immutabili.
    hashed_password = str(proc.stdout.read())
    list1 = list(hashed_password)
    list1[0] = ''
    hashed_password = ''.join(list1)
    list_users.append(fake.unique.email())
    f.write(users.format(email = list_users[i], firstname = fake.first_name_male(), lastname = fake.last_name_male(), pwd = hashed_password, pas = arg))

f.write("\n\n")

course = "INSERT INTO course (name, description, duration, price, average_evaluation) VALUES (\'{name}\', \'{description}\', {duration}, {price}, {average_evaluation});\n"

for i in range(size):
    f.write(course.format(name = fake.bs(), description = fake.sentence(nb_words = 50), duration = 0, price = (random.randrange(100,10000) / 100), average_evaluation = 0))

f.write("\n\n")

video = "INSERT INTO video (title, duration, type, file, id_course) VALUES (\'{title}\', {duration}, \'{type}\', \'{file}\', {course_id});\n"
list_types = ['mp4', 'avi', 'mkv', 'flv', 'mov', 'wmv', '3gp', 'webm', 'mpeg']
for i in range(size):
    # 'url' è un placeholder.
    f.write(video.format(title = fake.bs(), duration = random.randrange(1, 600), type = random.choice(list_types), file = 'url', course_id = (i+1)))

f.write("\n\n")

field = "INSERT INTO field (field_name) VALUES (\'{field_name}\');\n"
list_fields = ['Matematica', 'Chimica', 'Chimica Analitica', 'Chimica Applicata', 'Chimica Industriale',
               'Fisica', 'Fisica Applicata', 'Fisica e Astronomia', 'Fisica Nucleare', 'Giurisprudenza', 'Economia', 'Diritto della Economia',
               'Amministrazione, Economia e Finanza', 'Economia Aziendale', 'Economia Bancaria', 'Economia dei Mercati', 'Economia del Turismo', 
               'Economia di Impresa', 'Informatica', 'Informatica Sicurezza del Software', 'Informatica Intelligenza Artificiale',
               'Informatica Analisi dei Dati', 'Ingegneria', 'Ingegneria Aerospaziale', 'Ingegneria Biomedica', 'Ingegneria Chimica',
                'Ingegneria Informatica', 'Diritto', 'Diritto Civile', 'Diritto Penale', 'Diritto Amministrativo', 'Diritto Commerciale',
                'Filosofia', 'Lettere', 'Lettere Classiche', 'Lettere Moderne', 'Lettere e Beni Culturali', 'Medicina', 'Medicina Chirurgia',
                'Medicina Veterinaria','Scienze Biologiche', 'Scienze Chimiche', 'Scienze della Comunicazione', 'Scienze della Formazione',
                'Scienze della Nutrizione', 'Scienze della Psicologia', 'Scienze della Salute','Scienze della Terra e dello Ambiente e del Territorio',
                'Scienze della Educazione']
for i in range(len(list_fields)):
    f.write(field.format(field_name = list_fields[i]))

f.write("\n\n")

belong = "INSERT INTO belong (id_course, field_name) VALUES ({course_id}, \'{field_name}\');\n"
for i in range(size):
    f.write(belong.format(course_id = (i+1), field_name = random.choice(list_fields)))

f.write("\n\n")

list_follower = []
follow = "INSERT INTO follow (email_user, id_course) VALUES (\'{email_user}\', {id_course});\n"
for i in range(size):
    list_follower.append((random.choice(list_users), random.randrange(1,size+1)))

# Si ripulisce la lista da eventuali duplicati.
list_follower = list(set(list_follower))

for i in range(len(list_follower)):
    f.write(follow.format(email_user = list_follower[i][0], id_course = list_follower[i][1]))

f.write("\n\n")

evaluate = "INSERT INTO evaluate (email_user, id_course, feedback, vote) VALUES (\'{email_user}\', {id_course}, \'{feedback}\',{vote});\n"
for i in range(len(list_follower)):
    f.write(evaluate.format(email_user = list_follower[i][0], id_course = list_follower[i][1], feedback = 'NULL', vote = (random.randrange(0, 50) / 10)))

f.write("\n\n")

list_teachers = []
teach = "INSERT INTO teach (email_user, id_course) VALUES (\'{email_user}\', {id_course});\n"
for i in range(size):
    list_teachers.append((random.choice(list_users), random.randrange(1,size+1)))

list_teachers = list(set(list_teachers))

for i in range(len(list_teachers)):
    f.write(teach.format(email_user = list_teachers[i][0], id_course = list_teachers[i][1]))

f.close()
