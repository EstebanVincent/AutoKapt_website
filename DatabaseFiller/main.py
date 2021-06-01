import mysql.connector
from mysql.connector import Error
import random

def create_server_connection(host_name, user_name, user_password):
    '''Fonction qui se connecte au serveur de la base de données'''
    connection = None
    try:
        connection = mysql.connector.connect(
            host=host_name,
            user=user_name,
            passwd=user_password
        )
        print("MySQL Database connection successful")
    except Error as err:
        print(f"Error: '{err}'")

    return connection


def create_db_connection(host_name, user_name, user_password, db_name):
    '''Fonction qui se connecte à la base de données'''
    connection = None
    try:
        connection = mysql.connector.connect(
            host=host_name,
            user=user_name,
            passwd=user_password,
            database=db_name
        )
        print("MySQL Database connection successful")
    except Error as err:
        print(f"Error: '{err}'")

    return connection


def execute_query(connection, query):
    '''Fonction qui effectue une requête SQL modifiant la base'''
    cursor = connection.cursor()
    try:
        cursor.execute(query)
        connection.commit()
        print("Query successful")
    except Error as err:
        print(f"Error: '{err}'")


def read_query(connection, query):
    '''Fonction qui effectue une requête SQL obtenant des données'''
    cursor = connection.cursor()
    result = None
    try:
        cursor.execute(query)
        result = cursor.fetchall()
        return result
    except Error as err:
        print(f"Error: '{err}'")

def create_user(Nombre,First,Data=True):
    '''Fonction servant à créer Nombre utilisateurs appelés bot(First) à Bot(First+Nombre).
    Data détermine si on veut que les utilisateurs aient des tests générés aléatoiremebnt associés à eux.''' 
    for i in range(Nombre): #On effectue la suite pour chaque bot
        Username = "\'bot"+str(i+First)+"\'"
        Email = "\'bot"+str(i+First)+"@bot.fr\'"#On leurs donne un pseudi et un mail
        Password = "\'$2y$10$5R20WipkZsk5MOWy3k9Wpur.KkNii01TET2Sneiw5NkRsfp6GhpMe\'" #On prends un même mot de passe aléatoire pour tous les bots car il ne sera pas voulu de s'y connecter
        if random.randint(1,2) == 1:#On choisit leurs genre aléatoirement
            Gender = "\'Male\'"
        else:
            Gender = "\'Female\'"
        Birth = "\'"+str(random.randint(1950,2010))+"-"+str(random.randint(1,12))+"-"+str(random.randint(1,28))+"\'"#On choisit une date de naissance aléatoire entre le 01/01/195. et le 28/12/2010
        Access = "\'"+str(2)+"\'"#On impose l'accès de type user
        Request = Username+","+Email+","+Password+","+Gender+","+Birth+","+Access #On créé le str pour la requête à partir des variables
        execute_query(db,"INSERT INTO users (usersUsername,usersEmail,usersPassword,usersGender,usersBirth,usersAccess) VALUES ("+Request+")") #On execute la requête
        if Data:#Si on veut des tests pour l'utilisateur
            UserId = read_query(db, "SELECT usersId FROM users WHERE usersUsername="+Username)#On récupère son ID
            UserId=UserId[0][0]#Le résultat de la requête est une liste contenant un tupple dont le 1er élement est l'ID
            main_test(UserId)#On appelle la fonction qui appellera ensuite les tests respectifs


def LastBotUser():
    '''Fonction qui cherche le dernier bot créé pour ne pas avoir de doublon de nom'''
    temp = read_query(db, "SELECT usersUsername FROM users")#On prend tous les users
    for i in range (len(temp)):#On cherche dans tous les résultats
        current=temp[len(temp)-(i+1)][0]#On prend les usernames à partir de la fin
        if current.startswith('bot'):#Si l'utilisateur est un bot, on sais que c'est le dernier
            return int(current[3:]) #Enlève "bot"
    return 0 #Si il n'y a aucun bot

def main_test(UserID):
    '''Fonction qui appelle les générations automatiques des autres tests'''
    UserID = "\'" + str(UserID) + "\'"#On définit le UserID car il sera le même pour tous les tests
    for i in range(4):#On effectue la boucle suivante 4 fois
        Request = UserID+","+str(i)
        execute_query(db,"INSERT INTO test (usersId,testType) VALUES ("+Request+")")#On insère l'utilisateur et le type de test (0,1,2 ou 3)
        getTest = "SELECT testId FROM test WHERE usersId=" + UserID + "AND testType="+"\'"+str(i)+"\'"
        TestID = read_query(db, getTest)#On récupère l'ID du test pour la suite
        TestID = TestID[0][0]#Le résultat de la requête est une liste contenant un tupple dont le 1er élement est l'ID
        if i == 0:#Pour chaque type de test, on génère le test respectif
            test_stress(TestID)
        elif i == 1:
            test_reflex(TestID)
        elif i == 2:
            test_memory(TestID)
        elif i == 3:
            test_audition(TestID)


def test_stress(Id,BPMmin=40,BPMmax=140,TEMPmin=36,TEMPmax=39):
    '''On définit les intervales dans lesquels on veut générer nos résultats de tests
    On choisit ensuite aléatoirement une valeur entre le min et le max, puis on insère les données dans la table correspondante
    on verrifie aussi si les valeurs demandés ont du sens, sinon on prends des valeurs par défaut'''
    TestID = "\'" + str(Id) + "\'"

    if BPMmin<BPMmax:
        BPM = "\'" + str(random.randint(BPMmin, BPMmax)) + "\'"
    else:
        BPM = "\'"+str(random.randint(50,140))+"\'"

    if TEMPmin<TEMPmax:
        TempTest = random.randint(int(TEMPmin),int(TEMPmax-1))+random.randint(0,9)/10
    else:
        TempTest = random.randint(36,38)+random.randint(0,9)/10
    Temp = "\'" + str(TempTest) + "0\'"

    Request = BPM+","+Temp+","+TestID
    execute_query(db, "INSERT INTO stress (stressBPM,stressTemp,testId) VALUES (" + Request + ")")


def test_reflex(Id,VISUALmin=150,VISUALmax=500,SOUNDmin=150,SOUNDmax=500):
    '''On définit les intervales dans lesquels on veut générer nos résultats de tests
    On choisit ensuite aléatoirement une valeur entre le min et le max, puis on insère les données dans la table correspondante
    on verrifie aussi si les valeurs demandés ont du sens, sinon on prends des valeurs par défaut'''
    TestID = "\'" + str(Id) + "\'"

    if VISUALmin<VISUALmax:
        Visual ="\'"+str(random.randint(VISUALmin,VISUALmax))+"\'"
    else:
        Visual = "\'"+str(random.randint(150,500))+"\'"

    if SOUNDmin<SOUNDmax:
        Sound = "\'"+str(random.randint(SOUNDmin,SOUNDmax))+"\'"
    else:
        Sound = "\'"+str(random.randint(150,500))+"\'"

    Request= Visual+","+Sound+","+TestID
    execute_query(db, "INSERT INTO reflex (reflexVisual,reflexSound,testId) VALUES (" + Request + ")")

def test_memory(Id,SCOREmin=0,SCOREmax=100):
    '''On définit les intervales dans lesquels on veut générer nos résultats de tests
    On choisit ensuite aléatoirement une valeur entre le min et le max, puis on insère les données dans la table correspondante
    on verrifie aussi si les valeurs demandés ont du sens, sinon on prends des valeurs par défaut'''
    TestID = "\'" + str(Id) + "\'"

    if SCOREmax!=100 or SCOREmin!=0:
        temp = random.randint(SCOREmin,SCOREmax)
    else:#Si on cherche un score entre 0 et 100, on truque le résultat pour avoir quelque chose de plus réaliste
        temp = random.randint(0,100)

        if temp<50:
            temp2=random.randint(0,100)
            if temp+temp2<=100:
                temp = temp+temp2

    Score = "\'"+str(temp)+"\'"

    Request= Score+","+TestID
    execute_query(db, "INSERT INTO memory (memoryRythm,testId) VALUES (" + Request + ")")

def test_audition(Id,SCOREmin=0,SCOREmax=100):
    '''On définit les intervales dans lesquels on veut générer nos résultats de tests
    On choisit ensuite aléatoirement une valeur entre le min et le max, puis on insère les données dans la table correspondante
    on verrifie aussi si les valeurs demandés ont du sens, sinon on prends des valeurs par défaut'''
    TestID = "\'" + str(Id) + "\'"
    if SCOREmax!=100 or SCOREmin!=0:
        temp = random.randint(SCOREmin,SCOREmax)
    else:#Si on cherche un score entre 0 et 100, on truque le résultat pour avoir quelque chose de plus réaliste
        temp = random.randint(0, 100)

        if temp < 50:
            temp2 = random.randint(0, 100)
            if temp + temp2 <= 100:
                temp = temp + temp2

    Score = "\'" + str(temp) + "\'"
    Request = Score + "," + TestID
    execute_query(db, "INSERT INTO audition (auditionScore,testId) VALUES (" + Request + ")")


conn = create_server_connection("localhost", "root", "")
test = create_db_connection("localhost", "root", "", "test")
autokapt = create_db_connection("localhost", "root", "", "autokapt")

db=autokapt
create_user(100,LastBotUser()+1)


