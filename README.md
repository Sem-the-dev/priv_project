# Privilee challenge 🏊🏋️‍♀️

## Backend
Built using PHP and Slim framework as it is lightweight 

### Installation 
PHP version 8.3.1 

Composer version 2.6.6

Slim Framework 4

### Usage 
To run the application in development, you can run these commands 

cd into `priv_project/server`

`composer start`

Open `http://localhost:8080` in your browser.

### Endpoints
http://localhost:8080/data

http://localhost:8080/data/{name}

Example:
![img.png](img.png)

http://localhost:8080/data/{discount}

### CSV Converter
Ensure your CSV file is in the src directory

`cd priv_project/server/src` 

`php CsvConverter.php your_csv_file.csv`



## Frontend
Built using ReactJS

### Installation
Node version 18.12.1

cd into `priv_project/client` 

`npm install`

### Usage 

To run the application in development, you can run these commands 

cd into `priv_project/client`

`npm start`

Open `http://localhost:3002` in your browser.

## Future improvements 🚀
--> Filterable by both discount percentage and name at the same time

--> Still displays rest of the hotels when filtered by name 

--> Filterable using api endpoints in the client

--> Filter using xml output too 

--> Uninstall react-responive-carousel, as it has bugs 🐛,  with more time I would build my own carousel

