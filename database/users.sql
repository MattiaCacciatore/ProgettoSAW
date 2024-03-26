CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


/*nota a margine cosa succede se usassimo l'email come chiave primaria:
Performance: While using the email as the primary key simplifies some queries,
 it might impact performance. Queries involving joins or comparisons 
 with the primary key may be slower compared to using an integer-based primary key.
  Email addresses, being variable-length strings, 
  are generally slower to compare than integers.

Storage: Using email as the primary key may result in larger indexes and data storage,
    as emails are typically longer and can vary in length.
    This can impact database performance and storage requirements,
    especially in large-scale applications.

Data Integrity: Ensuring the uniqueness of email addresses is crucial for data integrity.
 By making the email field the primary key, 
 the database management system (DBMS) automatically enforces uniqueness.
 However, it's important to handle potential errors gracefully
 if a user attempts to register with an email that already exists.

*/