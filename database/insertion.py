# -----------------------------------------------------------------------------------------------------------------------
# Automatic script to generate fake and dummy tuples to populate the database for testing.
# 
# Made by Mattia Cacciatore <cacciatore1995@hotmail.it> - CS student ad UniGe Italy
# -----------------------------------------------------------------------------------------------------------------------
from faker import Faker
import sys
import subprocess
import random
# -----------------------------------------------------------------------------------------------------------------------
# Faker creates random strings which follow specific patterns.
fake = Faker('it_IT') # 'en_US'
# Number of tuples.
size = int(sys.argv[1])

list_users = []

command = 'php'

path = 'C:/path/to/hash.php' # TO BE MODIFIED!!!!!

f = open('population.sql', 'a')
# Prepared statements.
# -----------------------------------------------------------------------------------------------------------------------
users = "INSERT INTO user (email, firstname, lastname, pwd) VALUES (\'{email}\', \'{firstname}\', \'{lastname}\', {pwd}); /* la vera password è: {pas} */\n"

for i in range(size):
    arg = fake.unique.password(8,  special_chars=False)
    # The subprocess of the library allows us to execute a .php script through the shell passing the password
    # as argument.
    proc = subprocess.Popen([command, path, arg], shell=True, stdout=subprocess.PIPE)
    # Necessary cleaning step, the 'b' char at the start of the string shall be removed.
    hashed_password = str(proc.stdout.read())
    list1 = list(hashed_password)
    list1[0] = ''
    hashed_password = ''.join(list1)
    list_users.append(fake.unique.email())
    f.write(users.format(email = list_users[i], firstname = fake.first_name_male(), lastname = fake.last_name_male(), pwd = hashed_password, pas = arg))

f.write("\n\n")
# -----------------------------------------------------------------------------------------------------------------------
course = "INSERT INTO course (name, description, duration, price, average_evaluation) VALUES (\'{name}\', \'{description}\', {duration}, {price});\n"

for i in range(size):
    f.write(course.format(name = fake.bs(), description = fake.sentence(nb_words = 50), duration = 0, price = (random.randrange(100,10000) / 100)))

f.write("\n\n")
# -----------------------------------------------------------------------------------------------------------------------
video = "INSERT INTO video (title, duration, type, filename, id_course) VALUES (\'{title}\', {duration}, \'{type}\', \'{filename}\', {course_id});\n"

list_types = ['mp4', 'YT']

for i in range(size):
    f.write(video.format(title = fake.bs(), duration = random.randrange(1, 600), type = random.choice(list_types), filename = 'url', course_id = (i+1)))

f.write("\n\n")
# -----------------------------------------------------------------------------------------------------------------------
field = "INSERT INTO field (field_name) VALUES (\'{field_name}\');\n"

list_fields = ['DESIGN DEL PRODOTTO E DELLA COMUNICAZIONE', 'DESIGN DEL PRODOTTO NAUTICO', 'SCIENZE DELL\'ARCHITETTURA',
               'ECONOMIA AZIENDALE', 'ECONOMIA DELLE AZIENDE MARITTIME, DELLA LOGISTICA E DEI TRASPORTI',
               'SCIENZE DEL TURISMO: IMPRESA, CULTURA E TERRITORIO', 'SCIENZE ECONOMICHE E FINANZIARIE',
               'DIRITTO ED ECONOMIA DELLE IMPRESE', 'SERVIZI LEGALI ALL\'IMPRESA E ALLA PUBBLICA AMMINISTRAZIONE',
               'SERVIZIO SOCIALE', 'INGEGNERIA BIOMEDICA', 'INGEGNERIA CHIMICA E DI PROCESSO', 
               'INGEGNERIA CIVILE, EDILE E AMBIENTALE', 'INGEGNERIA DELL\'ENERGIA', 'INGEGNERIA ELETTRICA', 
               'INGEGNERIA ELETTRONICA E TECNOLOGIE DELL\'INFORMAZIONE', 'INGEGNERIA GESTIONALE', 'INGEGNERIA INFORMATICA', 
               'INGEGNERIA MECCANICA', 'INGEGNERIA NAUTICA', 'INGEGNERIA NAVALE', 
               'SCIENZE E CULTURE AGROALIMENTARI DEL MEDITERRANEO', 'TECNOLOGIE INDUSTRIALI', 
               'TECNOLOGIE PER L\'EDILIZIA E IL TERRITORIO', 'CONSERVAZIONE DEI BENI CULTURALI', 'FILOSOFIA', 'LETTERE', 
               'STORIA', 'LINGUE E CULTURE MODERNE', 'TEORIE E TECNICHE DELLA MEDIAZIONE INTERLINGUISTICA', 
               'ASSISTENZA SANITARIA', 'BIOTECNOLOGIE', 'DIETISTICA', 'EDUCAZIONE PROFESSIONALE', 'FISIOTERAPIA',
               'IGIENE DENTALE', 'INFERMIERISTICA', 'INFERMIERISTICA PEDIATRICA', 'LOGOPEDIA', 
               'ORTOTTICA ED ASSISTENZA OFTALMOLOGICA', 'OSTETRICIA', 'PODOLOGIA', 'SCIENZE MOTORIE, SPORT E SALUTE',
               'TECNICA DELLA RIABILITAZIONE PSICHIATRICA', 'TECNICHE DELLA PREVENZIONE NELL\'AMBIENTE E NEI LUOGHI DI LAVORO', 
               'TECNICHE DI FISIOPATOLOGIA CARDIOCIRCOLATORIA E PERFUSIONE CARDIOVASCOLARE', 'TECNICHE DI LABORATORIO BIOMEDICO',
               'TECNICHE DI NEUROFISIOPATOLOGIA', 'TECNICHE DI RADIOLOGIA MEDICA, PER IMMAGINI E RADIOTERAPIA',
               'TECNICHE ORTOPEDICHE', 'TERAPIA DELLA NEURO E PSICOMOTRICITA\' DELL\'ETA\' EVOLUTIVA', 
               'MEDIA, COMUNICAZIONE E SOCIETÀ', 'SCIENZE DELL\'EDUCAZIONE E DELLA FORMAZIONE', 'SCIENZE E TECNICHE PSICOLOGICHE',
               'CHIMICA E TECNOLOGIE CHIMICHE', 'FISICA', 'INFORMATICA', 'MATEMATICA', 'SCIENZA DEI MATERIALI',
               'SCIENZE AMBIENTALI E NATURALI', 'SCIENZE BIOLOGICHE', 'SCIENZE GEOLOGICHE', 
               'STATISTICA MATEMATICA E TRATTAMENTO INFORMATICO DEI DATI', 'POLITICHE, GOVERNANCE E INFORMAZIONE DELLO SPORT',
               'SCIENZE DELL\'AMMINISTRAZIONE E DELLA POLITICA', 'SCIENZE INTERNAZIONALI E DIPLOMATICHE']

for i in range(len(list_fields)):
    f.write(field.format(field_name = list_fields[i]))

f.write("\n\n")
# -----------------------------------------------------------------------------------------------------------------------
belong = "INSERT INTO belong (id_course, field_name) VALUES ({course_id}, \'{field_name}\');\n"

for i in range(size):
    f.write(belong.format(course_id = (i+1), field_name = random.choice(list_fields)))

f.write("\n\n")
# -----------------------------------------------------------------------------------------------------------------------
follow = "INSERT INTO follow (email_user, id_course) VALUES (\'{email_user}\', {id_course});\n"

list_followers = []

for i in range(size):
    list_followers.append((random.choice(list_users), random.randrange(1,size+1)))

# Remove all duplicates.
list_followers = list(set(list_followers))

for i in range(len(list_followers)):
    f.write(follow.format(email_user = list_followers[i][0], id_course = list_followers[i][1]))

f.write("\n\n")
# -----------------------------------------------------------------------------------------------------------------------
evaluate = "INSERT INTO evaluate (email_user, id_course, feedback, vote) VALUES (\'{email_user}\', {id_course}, \'{feedback}\',{vote});\n"

for i in range(len(list_followers)):
    f.write(evaluate.format(email_user = list_followers[i][0], id_course = list_followers[i][1], feedback = 'NULL', vote = (random.randrange(0, 50) / 10)))

f.write("\n\n")
# -----------------------------------------------------------------------------------------------------------------------
teach = "INSERT INTO teach (email_user, id_course) VALUES (\'{email_user}\', {id_course});\n"

list_teachers = []

for i in range(size):
    list_teachers.append((random.choice(list_users), random.randrange(1,size+1)))

list_teachers = list(set(list_teachers))

for i in range(len(list_teachers)):
    f.write(teach.format(email_user = list_teachers[i][0], id_course = list_teachers[i][1]))

f.close()