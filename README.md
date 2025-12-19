🌐 LAMP Stack Two-Tier Architecture on AWS
📌 Project Overview

This project demonstrates a production-style LAMP stack (Linux, Apache, MySQL, PHP) deployed on AWS using a secure two-tier architecture.

The objective of this project is to gain hands-on understanding of cloud networking, server configuration, security practices, and application-to-database communication, rather than just deploying a basic web application.

🏗️ Architecture

Client → Apache + PHP (Web EC2 – Public Subnet) → MySQL (DB EC2 – Private Subnet)

Custom VPC with public and private subnets

Web tier exposed to the internet

Database tier isolated in a private subnet

🛠️ Tools & Technologies Used

AWS EC2 (Amazon Linux 2023)

AWS VPC (Subnets, Route Tables, IGW, NAT Gateway)

Apache (httpd)

PHP

MySQL (MariaDB)

AWS Security Groups & NACLs

Linux (Shell & Server Administration)

Git & GitHub

🔄 Application & Infrastructure Workflow

User sends HTTP request from browser

Request reaches Apache on Web EC2 (public subnet)

PHP processes the request

PHP connects to MySQL using private IP

Database returns response

PHP renders output back to the user

⚙️ Setup & Configuration Summary

Created a custom VPC with CIDR planning

Configured public and private subnets

Attached Internet Gateway and NAT Gateway

Configured route tables for traffic flow

Launched Web EC2 and DB EC2 instances

Installed and configured Apache, PHP, and MySQL

Deployed PHP application

Tested full CRUD operations

🔐 Security Practices Implemented

Database EC2 has no public IP

MySQL access restricted to Web Security Group only

Least-privilege database user created

SSH access restricted and used temporarily

Proper file permissions for web application

Network isolation using subnets and route tables


🚧 Challenges Faced & How I Resolved Them

🔹 SSH Key Permission Error
Issue: SSH connection failed due to insecure private key permissions
Solution: Corrected key permissions using chmod 400 lamp-keyy.pem

🔹 SSH Access Worked with 0.0.0.0/0 but Not with My IP
Issue: SSH connection failed when restricted to my public IP
Solution: Temporarily allowed 0.0.0.0/0 to debug, verified connectivity, and understood source IP handling in Security Groups

🔹 HTTP vs HTTPS Access Issue
Issue: Website not accessible using HTTPS
Solution: Verified Apache was configured only for HTTP (port 80) and accessed the application using HTTP

🔹 Website Not Reachable from Browser
Issue: Apache was running but the site did not load in the browser
Solution: Fixed missing HTTP (port 80) inbound rule in the Web Security Group

🔹 PHP Not Executing Issue
Issue: PHP files were downloading instead of executing
Solution: Installed missing PHP packages and MySQL PHP driver, then restarted Apache

🔹 Private Database Connectivity Issue
Issue: PHP application could not connect to the MySQL database
Solution: Configured Security Group–to–Security Group rule allowing port 3306 from Web EC2 to DB EC2

🔹 Private Subnet Internet Access Issue
Issue: Database EC2 could not access the internet for package installation
Solution: Created a NAT Gateway and updated the private route table

🔹 File Permission Issue in Web Directory
Issue: Apache could not read PHP files properly
Solution: Updated file permissions under /var/www/html

✅ Final Outcome

Apache and PHP successfully serving web requests

MySQL securely running in private subnet

PHP application connected to database

Full CRUD operations verified

Secure two-tier LAMP architecture achieved

👩‍💻 Author

Shikha Mathur
Aspiring Cloud & DevOps Engineer
