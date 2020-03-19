CREATE TABLE Employees (
    EmployeeID int NOT NULL AUTO_INCREMENT,
    FirstName varchar(255),
    LastName varchar(255),
    PhoneNumber varchar(255),
    Email varchar(255),
    Status varchar(255),
    HireDate varchar(255),
    Title varchar(255),
    AccessCode varchar(255),
	PRIMARY KEY(EmployeeID)
    -- OrderID int NOT NULL PRIMARY KEY,
    -- OrderNumber int NOT NULL,
    -- PersonID int FOREIGN KEY REFERENCES Persons(PersonID)
);

CREATE TABLE Products (
    ProductID int AUTO_INCREMENT,
    ProductName varchar(255),
    Cost float,
    Availible bit,
    PRIMARY KEY(ProductID)
);
CREATE TABLE EmployeePersonalData (
    SSN varchar(255) NOT NULL,
    EmployeeID int,
    EmployeePay float,
    StreetAddress varchar(255),
    APTNumber varchar(255),
    City varchar(255),
    USState varchar(255),
    ZipCode int,
    DOB date,
    PRIMARY KEY(SSN),
    FOREIGN KEY(EmployeeID) REFERENCES Employees(EmployeeID)
);
CREATE TABLE Orders(
    OrderID int AUTO_INCREMENT,
    StoreName varchar(255),
    OrderDate date,
    OrderStatus bit,
    PRIMARY Key(OrderId)
);
CREATE TABLE Payments (
    PaymentID int AUTO_INCREMENT,
    PaymentType varchar(255) NOT NULL,
    CardType varchar(255),
    CardNumber varchar(20),
    ZipCode varchar(10),
    FirstName varchar(255),
    LastName varchar(255),
    ExpirationDate date,
    PRIMARY KEY(PaymentID)
);
CREATE TABLE EmployeeTransactions (
    EmployeeTransactionID int AUTO_INCREMENT,
    EmployeeTransactionDate date,
    TransactionTotal float,
    TransactionType varchar(255),
    -- ProductName varchar(255),
    -- ProductCost float,
    EmployeeID int,
    OrderID int,
    PaymentID int,
    PRIMARY KEY(EmployeeTransactionID),
    FOREIGN KEY(OrderID) REFERENCES Orders(OrderID),
    FOREIGN KEY(PaymentID) REFERENCES Payments(PaymentID)

);



CREATE TABLE OrderDetails (
    DetailsID int AUTO_INCREMENT,
    ProductID int,
    OrderID int,
    ItemQuantity int,
    AddOns varchar(255),
    PRIMARY KEY(DetailsID),
    FOREIGN KEY(ProductID) References Products(ProductID),
    FOREIGN KEY(OrderID) References Orders(OrderID)
);



CREATE TABLE Customers (
    CustomerID int AUTO_INCREMENT,
    FirstName varchar(255),
    LastName varchar(255),
    PhoneNumber varchar(12),
    Email varchar(255),
    Address varchar(255),
    APTNumber varchar(255),
    City varchar(255),
    State varchar(2),
    ZipCode varchar(255),
    DOB date,
	PRIMARY KEY(CustomerID)
);

CREATE TABLE CustomerTransactions (
    CustomerTransactionID int AUTO_INCREMENT,
    TransactionDate date,
    TransactionTotal float,
    TransactionType varchar(255),
    CustomerID int,
    OrderID int,
    PaymentID int,
    PRIMARY KEY(CustomerTransactionID),
    FOREIGN KEY(CustomerID) REFERENCES Customers(CustomerID),
    FOREIGN KEY(OrderID) REFERENCES Orders(OrderID),
    FOREIGN KEY(PaymentID) REFERENCES Payments(PaymentID)
);

