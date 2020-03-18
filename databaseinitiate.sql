CREATE TABLE Employees (
    EmployeeID int NOT NULL PRIMARY KEY,
    EmployeeFirstName varchar(255),
    EmployeeLastName varchar(255),
    EmployeePhoneNumber varchar(255),
    EmployeeEmail varchar(255),
    EmployeeStatus varchar(255),
    EmployeeHireDate varchar(255),
    EmployeeTitle varchar(255),
    EmployeeAccessCode varchar(255)

    --OrderID int NOT NULL PRIMARY KEY,
    --OrderNumber int NOT NULL,
    --PersonID int FOREIGN KEY REFERENCES Persons(PersonID)
);
CREATE TABLE Products (
    ProductID int identity(1,1) PRIMARY KEY,
    ProductName varchar(255),
    Cost money,
    Availible bit
);
CREATE TABLE EmployeePersonalData (
    SSN varchar(255) NOT NULL PRIMARY KEY,
    EmployeeID int FOREIGN KEY REFERENCES Employees(EmployeeID),
    EmployeePay money,
    StreetAddress varchar(255),
    APTNumber varchar(255),
    City varchar(255),
    USState varchar(255),
    ZipCode int,
    DOB date
);
CREATE TABLE Orders(
    OrderID int IDENTITY(1,1) PRIMARY KEY,
    StoreName varchar(255),
    OrderDate date,
    OrderStatus bit
);
CREATE TABLE Payments (
    PaymentID int IDENTITY(1,1) PRIMARY KEY,
    PaymentType varchar(255) NOT NULL,
    CardType varchar(255),
    CardNumber varchar(20),
    ZipCode varchar(10),
    FirstName varchar(255),
    LastName varchar(255),
    ExpirationDate date
);
CREATE TABLE EmployeeTransactions (
    EmployeeTransactionID int IDENTITY(1,1) PRIMARY KEY,
    EmployeeTransactionDate date,
    TransactionTotal money,
    TransactionType varchar(255),
    --ProductName varchar(255),
    --ProductCost money,
    EmployeeID int FOREIGN KEY REFERENCES Employees(EmployeeID),
    OrderID int FOREIGN KEY REFERENCES Orders(OrderID),
    PaymentID int FOREIGN KEY REFERENCES Payments(PaymentID)

);



CREATE TABLE OrderDetails (
    DetailsID int IDENTITY(1,1) Primary key,
    ProductID int FOREIGN KEY REFERENCES Products(ProductID),
    ItemQuantity int,
    AddOns varchar(255),
    OrderID int FOREIGN KEY REFERENCES Orders(OrderID)
);



CREATE TABLE Customers (
    CustomerID int identity(1,1) PRIMARY KEY,
    CustomerFirstName varchar(255),
    CustomerLastName varchar(255),
    CustomerPhoneNumber varchar(12),
    CustomerEmail varchar(255),
    CustomerAddress varchar(255),
    CustomerAPTNumber varchar(255),
    CustomerCity varchar(255),
    CustomerState varchar(2),
    CustomerZipCode varchar(255),
    CustomerDOB date
);

CREATE TABLE CustomerTransactions (
    CustomerTransactionID int identity(1,1) PRIMARY KEY,
    TransactionDate date,
    TransactionTotal float,
    TransactionType varchar(255),
    CustomerID int FOREIGN KEY REFERENCES Customers(CustomerID),
    OrderID int FOREIGN KEY REFERENCES Orders(OrderID),
    PaymentID int FOREIGN KEY REFERENCES Payments(PaymentID),
);

