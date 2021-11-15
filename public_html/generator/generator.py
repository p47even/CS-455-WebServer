import random

tables = ['Student','Dept','Course',] #Only generates Students and creates statments for Students, Courses, and Departments currently

nameFile = 'firstNames.txt'
numNames = 4944
numStudentsGenerated = 25
classes = ['Freshman','Sophomore','Junior','Senior']

courseFile = 'courses.txt'
numCourses = 7

departmentFile = 'depts.txt'
numDepts = 19

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


def randomStudents(names, toGenerate): #Prepare random student data
    i = 0
    data = []
    while i<toGenerate :
        firstName = random.choice(names)
        lastName = random.choice(names)
        classNum = random.randrange(0,3,1)
        gpa = round(random.uniform(0.0,4.0),1)

        fullName = firstName[0]+' '+lastName[0]
        currClass = classes[classNum]
        currStudent = [i, fullName, currClass, gpa]
        data.append(currStudent)
        i+=1
    return data #[studentID, name, class, gpa]


def createStatement(list, table): #create and print insert statement
    for item in list:
        statement = 'INSERT INTO '+table+' VALUES ('
        for i,attr in enumerate(item) :
            statement+=str(attr)
            if i != len(item)-1 : #check if last attribute 
                statement += ', '
        statement+=');'
        print(statement)


rawNames = readFile(nameFile)
courses = readFile(courseFile)
departments = readFile(departmentFile)

students = randomStudents(rawNames, numStudentsGenerated)

createStatement(students,tables[0])
createStatement(departments,tables[1])
createStatement(courses,tables[2])
