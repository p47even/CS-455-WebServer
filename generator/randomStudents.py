import random
nameFile = 'firstNames.txt'
numNames = 4944
numStudentsGenerated = 6
classes = ['Freshman','Sophomore','Junior','Senior']

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
    #data = [] #uncomment this and others for array format
    while i<toGenerate :
        firstName = random.choice(names)
        lastName = random.choice(names)
        classNum = random.randrange(0,4,1)
        gpa = round(random.uniform(0.0,4.0),1)

        fullName = firstName[0]+' '+lastName[0]
        print(fullName) #print some random names
        currClass = classes[classNum]
        #print(str(i)+','+fullName+','+currClass+','+str(gpa)) #print raw student data
        #currStudent = [i, fullName, currClass, gpa] #uncomment this and others for array format
        #data.append(currStudent) #uncheck this and others for array format
        i+=1
    #return data #[studentID, name, class, gpa] #uncomment this and others for array format

rawNames = readFile(nameFile)
randomStudents(rawNames,numStudentsGenerated)