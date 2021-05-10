import mysql.connector
from mysql.connector import Error
import random

def create_server_connection(host_name, user_name, user_password):
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
    cursor = connection.cursor()
    try:
        cursor.execute(query)
        connection.commit()
        print("Query successful")
    except Error as err:
        print(f"Error: '{err}'")


def read_query(connection, query):
    cursor = connection.cursor()
    result = None
    try:
        cursor.execute(query)
        result = cursor.fetchall()
        return result
    except Error as err:
        print(f"Error: '{err}'")

def create_user(Nombre,First,Data=True):
    for i in range(Nombre):
        Username = "\'bot"+str(i+First)+"\'"
        Email = "\'bot"+str(i+First)+"@bot.fr\'"
        Password = "\'$2y$10$5R20WipkZsk5MOWy3k9Wpur.KkNii01TET2Sneiw5NkRsfp6GhpMe\'"
        if random.randint(1,2) == 1:
            Gender = "\'Male\'"
        else:
            Gender = "\'Female\'"
        Birth = "\'"+str(random.randint(1950,2010))+"-"+str(random.randint(1,12))+"-"+str(random.randint(1,28))+"\'"
        Access = "\'"+str(2)+"\'"
        Request = Username+","+Email+","+Password+","+Gender+","+Birth+","+Access
        execute_query(db,"INSERT INTO users (usersUsername,usersEmail,usersPassword,usersGender,usersBirth,usersAccess) VALUES ("+Request+")")
        if Data:
            UserId = read_query(db, "SELECT usersId FROM users WHERE usersUsername="+Username)
            UserId=UserId[0][0]
            main_test(UserId)


def LastBotUser():
    temp = read_query(db, "SELECT usersId,usersUsername FROM users")
    for i in range (len(temp)):
        current=temp[len(temp)-(i+1)][1]
        if current.startswith('bot'):
            return int(current[3:]) #Enlève "bot"
    return 0

def main_test(UserID):
    UserID = "\'" + str(UserID) + "\'"
    for i in range(4):
        Request = UserID+","+str(i)
        execute_query(db,"INSERT INTO test (usersId,testType) VALUES ("+Request+")")
        getTest = "SELECT testId FROM test WHERE usersId=" + UserID + "AND testType="+"\'"+str(i)+"\'"
        TestID = read_query(db, getTest)
        TestID = TestID[0][0]
        if i == 0:
            test_stress(TestID)
        elif i == 1:
            test_reflex(TestID)
        elif i == 2:
            test_memory(TestID)
        elif i == 3:
            test_audition(TestID)


def test_stress(Id,BPMmin=40,BPMmax=140,TEMPmin=36,TEMPmax=39):
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
    TestID = "\'" + str(Id) + "\'"
    if SCOREmax!=100 or SCOREmin!=0:
        temp = random.randint(SCOREmin,SCOREmax)
        Score = "\'" + str(temp) + "\'"
    else:
        temp = random.randint(0,100)
        if temp<50:
            temp2=random.randint(0,100)
            if temp+temp2<=100:
                Score = "\'" + str(temp+temp2) + "\'"
            else:
                Score = "\'" + str(temp) + "\'"
        else:
            Score = "\'"+str(temp)+"\'"
    Request= Score+","+TestID
    execute_query(db, "INSERT INTO memory (memoryRythm,testId) VALUES (" + Request + ")")

def test_audition(Id,SCOREmin=0,SCOREmax=100):
    TestID = "\'" + str(Id) + "\'"
    if SCOREmax!=100 or SCOREmin!=0:
        temp = random.randint(SCOREmin,SCOREmax)
        Score = "\'" + str(temp) + "\'"
    else:
        temp = random.randint(0, 100)
        if temp < 50:
            temp2 = random.randint(0, 100)
            if temp + temp2 <= 100:
                Score = "\'" + str(temp + temp2) + "\'"
            else:
                Score = "\'" + str(temp) + "\'"
        else:
            Score = "\'" + str(temp) + "\'"
    Request = Score + "," + TestID
    execute_query(db, "INSERT INTO audition (auditionScore,testId) VALUES (" + Request + ")")


conn = create_server_connection("localhost", "root", "")
test = create_db_connection("localhost", "root", "", "test")
autokapt = create_db_connection("localhost", "root", "", "autokapt")

db=autokapt

create_user(100,LastBotUser()+1)


