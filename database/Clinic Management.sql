DROP TABLE IF EXISTS Bill;
DROP TABLE IF EXISTS Payment;
DROP TABLE IF EXISTS Prescribe;
DROP TABLE IF EXISTS Medicine;
DROP TABLE IF EXISTS Appointment;
DROP TABLE IF EXISTS Treatment;
DROP TABLE IF EXISTS Patient;
DROP TABLE IF EXISTS Clinic_Assistant ;
DROP TABLE IF EXISTS Doctor;
DROP TABLE IF EXISTS User;


CREATE TABLE Patient (
patient_ID INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
IC_no VARCHAR(13) NOT NULL,
gender BOOLEAN NOT NULL,
number VARCHAR(12) NOT NULL,
address VARCHAR(255) NOT NULL,
email VARCHAR(255) NOT NULL,
User_Id INT NOT NULL)
ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE Clinic_Assistant  (
ClinicAsst_ID INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
name VARCHAR(30) NOT NULL,
IC_no VARCHAR(12) NOT NULL,
gender BOOLEAN NOT NULL,
number VARCHAR(12) NOT NULL,
address VARCHAR(255) NOT NULL,
email VARCHAR(255) NOT NULL,
User_Id INT NOT NULL)
ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE Treatment (
Treatment_ID INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
Treat_Name VARCHAR(25) NOT NULL,
Treat_Result VARCHAR(50) NOT NULL)
ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE Appointment (
Treatment_ID INT NOT NULL,
DocID INT NOT NULL,
Patient_ID INT NOT NULL,
Date DATE NOT NULL,
Time TIME NOT NULL)
ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE Payment (
pay_ID INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
Type VARCHAR(20) NOT NULL)
ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE Medicine (
medicine_ID INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
Name VARCHAR(50) NOT NULL,
Exp_Date DATE NOT NULL,
Price DOUBLE NOT NULL)
ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE Doctor (
Doc_ID INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
name VARCHAR(30) NOT NULL,
IC_no VARCHAR(12) NOT NULL,
gender BOOLEAN NOT NULL,
number VARCHAR(12) NOT NULL,
email VARCHAR(255) NOT NULL,
User_Id INT NOT NULL)
ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE Prescribe (
PrescribeID INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
med_ID INT NOT NULL,
Treat_ID INT NOT NULL,
quantity INT NOT NULL,
Dose VARCHAR(20) NOT NULL)
ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE Bill (
Bill_ID INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
PrescribeID INT NOT NULL,
pay_ID INT NOT NULL,
Date DATE NOT NULL,
Amount DOUBLE NOT NULL)
ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE User (
User_ID INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
No_ID VARCHAR(20) NOT NULL,
pswd VARCHAR(255) NOT NULL,
Role  INT NOT NULL)
ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE Patient ADD CONSTRAINT Patient_User_UserID FOREIGN KEY (User_Id) REFERENCES User(User_ID) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE Clinic_Assistant  ADD CONSTRAINT ClinicAssistant_User_UserID FOREIGN KEY (User_Id) REFERENCES User(User_ID) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE Appointment ADD CONSTRAINT Appointment_Treatment_TreatmentID FOREIGN KEY (Treatment_ID) REFERENCES Treatment(Treatment_ID) ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE Appointment ADD CONSTRAINT Appointment_Doctor_DocID FOREIGN KEY (DocID) REFERENCES Doctor(Doc_ID) ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE Appointment ADD CONSTRAINT Appointment_Patient_patientID FOREIGN KEY (Patient_ID) REFERENCES Patient(patient_ID) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE Doctor ADD CONSTRAINT Doctor_User_UserID FOREIGN KEY (User_Id) REFERENCES User(User_ID) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE Prescribe ADD CONSTRAINT Prescribe_Medicine_medicineID FOREIGN KEY (med_ID) REFERENCES Medicine(medicine_ID) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE Prescribe ADD CONSTRAINT Prescribe_Treatment_TreatmentID FOREIGN KEY (Treat_ID) REFERENCES Treatment(Treatment_ID) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE Bill ADD CONSTRAINT Bill_PrescribeID_Prescribe_PrescribeID FOREIGN KEY (PrescribeID) REFERENCES Prescribe(PrescribeID) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE Bill ADD CONSTRAINT Bill_pay_ID_Payment_pay_ID FOREIGN KEY (pay_ID) REFERENCES Payment(pay_ID) ON DELETE CASCADE ON UPDATE CASCADE;