PRAGMA foreign_keys = ON;

-- Delete tables if they already exist
drop table if exists Discussion;
drop table if exists isRequired;
drop table if exists Class;
drop table if exists Enroll;
drop table if exists Course;
drop table if exists ProfessorLogin;
drop table if exists DepartmentHeads;
drop table if exists Professor;
drop table if exists Minor;
drop table if exists Major;
drop table if exists Department;
drop table if exists StudentLogin;
drop table if exists Students;

-- Schema
create TABLE Students(
    studentID integer primary key,
    studentName text not null,
    class text check(class = 'Freshman' or class = 'Sophomore' or class = 'Junior' or class = 'Senior'),
    gpa real check(0 <= gpa and gpa <= 4)
);
create table StudentLogin(
    studentID integer primary key,
    userName text,
    stuPassword text,
    foreign key (studentID) references Students(studentID)
        on update cascade
        on delete cascade    
);
create table Department(
    deptID text primary key check (length(deptID) <= 4),
    departmentName text,
    building name
);
create table Major(
    studentID integer,
    major text,
    primary key (studentID, major),
    foreign key (studentID) references Students(studentID)
        on update cascade
        on delete cascade,
	foreign key (major) references Dept (deptID)
		on update cascade
		on delete set null
);
create table Minor(
    studentID integer,
    minor text,
    primary key (studentID, minor),
    foreign key (studentID) references Students(studentID)
        on update cascade
        on delete cascade,
	foreign key (minor) references Dept (deptID)
		on update cascade
		on delete set null    
);
create table Professor(
    facultyID integer primary key,
    professorName text,
    deptID text,
    foreign key (deptID) references Department(deptID)
        on update cascade
        on delete cascade    
);
create table DepartmentHeads( 
    deptID text,
    departmentHeadID integer,
    primary key (deptID, departmentHeadID),
    foreign key (deptID) references Department(deptID)
        on update cascade
        on delete cascade,
    foreign key (departmentHeadID) references Professor(facultyID)
        on update cascade
        on delete cascade
);
create table ProfessorLogin(
    facultyID integer primary key,
    userName text,
    facPassword text,
    foreign key (facultyID) references Professor(facultyID)
        on update cascade
        on delete cascade    
);
create table Course(
    courseID integer primary key,
    deptID text,
    courseName text,
    fallSemester integer check (fallSemester = 1 or fallSemester = 0), -- 0: Is not in fall semester.  1: Is in fall semester
    springSemester integer check (springSemester = 1 or springSemester = 0),
    foreign key (deptID) references Department(deptID)
        on update cascade
        on delete cascade
);
create table Enroll(
    studentID integer,
    courseID integer,
    primary key (studentID, courseID),
    foreign key (studentID) references Students(studentID)
        on update cascade
        on delete cascade,
    foreign key (courseID) references Course(courseID)
        on update cascade
        on delete cascade
);
create table isMeeting(
    courseID integer,
    facultyID integer,
    section text check (section like '[A-Z]'),
    meetDay text
        check (meetDay = 'Monday' or meetDay = 'Tuesday' or meetDay = 'Wednesday' or meetDay = 'Thursday' or meetDay = 'Friday'),
    meetTime text check (meetTime = '[0-9][0-9]/[0-9][0-9]'),
    location text,
    primary key (courseID, section),
    foreign key (facultyID) references Professor(facultyID)
        on update cascade
        on delete cascade,
    foreign key (courseID) references Course(courseID)
        on update cascade
        on delete cascade
);
--create table Class(
--    facultyID integer, 
--    courseID integer,
--    section text check section like '[A-Z]',
--    deptID text,
--    meetDay text, 
--    meetTime text,
--    location text,
--    primary key (courseID, section), 
--    foreign key (facultyID) references Professor(facultyID)
--        on update cascade
--        on delete cascade,
--    foreign key (courseID) references Course(courseID)
--        on update cascade
--        on delete cascade,
--    foreign key (deptID) references Department(deptID)
--        on update cascade
--        on delete cascade
--);
create table isRequired(
    courseID integer,
    requirementID integer,
    primary key (courseID, requirementID),
    foreign key (courseID) references Class(courseID)
        on update cascade
        on delete cascade,
    foreign key (requirementID) references Class(courseID)
        on update cascade
        on delete cascade
);
create table Discussion(
    studentID integer,
    courseID integer,
    facultyID integer,
    comment text,
    date text check (date like '[0-9][0-9]/[0-9][0-9]/[0-9][0-9][0-9][0-9]'), 
    time text check (time like '[0-9][0-9]:[0-9][0-9]:[0-9][0-9]'),
    primary key (studentID, date, time),
    foreign key (studentID) references Students(studentID)
        on update cascade
        on delete cascade,
    foreign key (courseID) references Course(courseID)
        on update cascade
        on delete cascade,
    foreign key (facultyID) references Professor(facultyID)
        on update cascade
        on delete cascade      
);