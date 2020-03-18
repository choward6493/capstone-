USE [Capstone]
GO

INSERT INTO [dbo].[Customers]
           ([CustomerFirstName]
           ,[CustomerLastName]
           ,[CustomerPhoneNumber]
           ,[CustomerEmail]
           ,[CustomerAddress]
           ,[CustomerAPTNumber]
           ,[CustomerCity]
           ,[CustomerState]
           ,[CustomerZipCode]
           ,[CustomerDOB])
     VALUES
           ('Test','Dummy','16144670711','arenninger@student.cscc.edu','1234 Columbus State',null,'Columbus','OH','43123',TO_DATE('01/01/2001', 'DD/MM/YYYY'))
GO

