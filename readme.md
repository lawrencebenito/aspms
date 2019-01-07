<h1>Apparel Sales and Production Management System</h1>   

## About ASPMS
This system will be used to Manage SALES and PRODUCTION of an Apparel Enterprise. It uses browser but was agreed to be only used locally. The purpose of using the web development for this LAN based system is for portability. With 3 modules(Admin, Production Manager, and Employee) the users may be freely to use any browser or device use the system. 

## Modules
### Admin Module
Manage the following data:
* Maintenance (Data Section of the system)
  * contains most of the data that will be used by other section or modules
* Sales
  * Products
  * Quotations
  * Orders
    * Each item in the order list must have Invoice(with contract), Official Reciept, and Delivery Reciept
* Production
  * Job Orders
    * Orders(from sales) must be translated to be job orders, price and other sales info will be removed, Job orders contain details for production like order quantity, start and end of production, estimated delivery date
  * Production Log
    * Contains the input/everyday log of employees(tailors)
    * The admin and the production manager can monitor, accept and decline employees log everyday
* Reports
  * Contains, of course, the reports of Sales and Production
    
### Production Manager Module
A copy of the Production section of the Admin module. Just to seperate the access of Production Managers to sales

### Employees Module
A simple GUI made for phones or tablets so the employee can log their every day work. how many they have sewn, cut, packed for that day. which later on will be approved by the Production Manager or by the Admin.     

## Build
This system is built with following:

Language: PHP with Laravel Framework <br/>
Design: Admin-LTE Bootstrap Template. <br/>
Database: MySQL with MySQL Workbench(I haven't tested it with phpMyAdmin on XAMPP) <br/>
Server: Apache from XAMPP <br/>
Text Editor: Microsoft Visual Studio Code <br/>
Version Control System: Git(local) and GitHub <br/>

## Manual
Use default configurations of <u>xampp</u>, must place the "apsms" folder to htdocs

To access the site, use -> http://localhost/apsms/public

Database main <b>.sql</b> is located to the <b>database</b> folder. Import the file to your preferred dbms. I tested the system with MySQL Workbench.

