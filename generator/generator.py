import random

#Creates statements to be entered in SQLite
 
tables = ['Students','StudentLogin','Department','Major','Minor','Professor','DepartmentHeads','ProfessorLogin','Course','Enroll','isMeeting','isRequired'] #full list

studentFile = 'sampleStudents.txt'
studentLoginFile = 'studentLogins.txt'
departmentFile = 'depts.txt'
majorFile = 'major.txt'
minorFile = 'minor.txt'
profFile = 'sampleProfs.txt'
headFile = 'heads.txt'
profLoginFile = 'profLogins.txt'
courseFile = 'courses.txt'
enrollFile = 'enrollments.txt'
isMeetingFile = 'isMeetings.txt'
isRequiredFile = 'requirements.txt'


fileNames = [studentFile]
fileNames.extend([studentLoginFile,departmentFile,majorFile,minorFile,profFile,headFile,profLoginFile,courseFile,enrollFile,isMeetingFile,isRequiredFile]) #full list

def toString(list):
    for item in list: print(item)

def addQuotes(str): return '\''+str+'\''


def readFile(fileName): #reads file
    file = open(fileName)
    next(file) #skips first line
    data = []
    for line in file :
        line = line.strip() #strips \n character
        split = line.split(',')
        data.append(split)
    file.close()
    return data

def createStatement(list, table): #create and print insert statement
    for item in list:
        statement = 'INSERT INTO '+table+' VALUES ('
        for i,attr in enumerate(item) :
            if not attr.isnumeric() : attr = addQuotes(attr)
            statement+=str(attr)
            if i != len(item)-1 : #check if last attribute 
                statement += ', '
        statement+=');'
        print(statement)



data = []

for fileName in fileNames :
    data.append(readFile(fileName))

for i,v in enumerate(data) : 
   createStatement(v,tables[i])