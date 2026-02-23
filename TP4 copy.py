import mysql.connector
import csv  
import datetime

host = "etu-mysql.iut2.univ-grenoble-alpes.fr"
user = "stentzey"
password = "0111"
database = "stentzey3"

conn = mysql.connector.connect(
    host=host,
    user=user,
    password=password,
    database=database
)

if conn.is_connected():
    print("Connexion réussie à la base de données MySQL")
else:
    print("Échec de la connexion à la base de données MySQL")


#cursor = conn.cursor()

#create_table_query = """
#CREATE TABLE clients ( 
#    id_client INT PRIMARY KEY, 
#    nom VARCHAR(50), 
#    prenom VARCHAR(50), 
#    email VARCHAR(100) UNIQUE, 
#    date_inscription DATE, 
#    ville VARCHAR(50) 
#)
#"""

#try:
#    cursor.execute(create_table_query)
#    print("Table 'clients' créée avec succès (ou déjà existante).")

# except mysql.connector.Error as err:
 #   print(f"Erreur lors de la création de la table : {err}")

#cursor.close()
#conn.close()  

# --- Lecture du fichier CSV ---

# Lire le fichier ligne par ligne
with open('clients.csv', mode='r') as file:
    csv_reader = csv.reader(file, delimiter=';')
    next(csv_reader)  
    for row in csv_reader:
        print(row)  
# Compter le nombre de lignes lues
with open('clients.csv', mode='r') as file:
    csv_reader = csv.reader(file, delimiter=';')
    next(csv_reader)
    count = sum(1 for _ in csv_reader)
    print(f"Nombre de lignes dans le fichier CSV : {count}")

# --- Nettoyage des données ---
cleaned_data = []
invalid_rows = 0

with open('clients.csv', mode='r', newline='') as csvfile:
    csv_reader = csv.reader(csvfile, delimiter=';')
    header = [col.strip() for col in next(csv_reader)]

    for row in csv_reader:
        cleaned_row = [field.strip() for field in row]

        if len(cleaned_row) != 6:
            invalid_rows += 1
            continue

        raw_date = cleaned_row[4]
        if raw_date:
            parsed_date = None
            for fmt in ('%Y-%m-%d', '%d/%m/%Y', '%Y/%m/%d'):
                try:
                    parsed_date = datetime.datetime.strptime(raw_date, fmt)
                    break
                except ValueError:
                    pass

            if parsed_date is not None:
                cleaned_row[4] = parsed_date.strftime('%Y-%m-%d')
            else:
                cleaned_row[4] = 'NULL'

        cleaned_row = [field if field else 'NULL' for field in cleaned_row]
        cleaned_data.append(cleaned_row)

with open('clients.csv', mode='w', newline='') as csvfile:
    writer = csv.writer(csvfile, delimiter=';')
    writer.writerow(header)
    writer.writerows(cleaned_data)

print(f"Nettoyage terminé : {len(cleaned_data)} lignes conservées, {invalid_rows} lignes ignorées.")

# --- Insertion des données dans la base MySQL ---
#Insérer les données ligne par ligne
cursor = conn.cursor()
insert_query = """
INSERT INTO clients (id_client, nom, prenom, email, date_inscription, ville) 
VALUES (%s, %s, %s, %s, %s, %s)
"""

for row in cleaned_data:
    try:
        cursor.execute(insert_query, tuple(row))
        conn.commit()
    except mysql.connector.Error as err:
        print(f"Erreur lors de l'insertion de la ligne {row}: {err}")
 
nb_inserted = len(cleaned_data)
nb_rejected = invalid_rows
print(f"Nombre de lignes insérées : {nb_inserted}")
print(f"Nombre de lignes rejetées : {nb_rejected}")

cursor.close()
conn.close()

# --- Journalisation ---``

# Insérer un enregistrement dans la table log_integration




