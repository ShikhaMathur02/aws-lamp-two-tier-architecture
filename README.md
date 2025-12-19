# AWS LAMP Two-Tier Architecture Project

## 📌 Project Overview
This project implements a secure two-tier LAMP stack architecture on AWS, designed to simulate a real-world web application deployment.

The primary goal of this project is to gain hands-on experience with cloud infrastructure, networking, and security by separating the web and database layers into isolated environments.

The web tier runs Apache and PHP in a public subnet, while the database tier runs MySQL in a private subnet with restricted access. The project emphasizes VPC design, traffic flow, security group configuration, and real-world troubleshooting rather than just application development.

---

## ❓ Why LAMP Stack?
LAMP (Linux, Apache, MySQL, PHP) is a widely used and reliable web stack that helps build strong fundamentals in:
- 🐧 Linux server administration
- 🌐 Web server configuration
- 🔗 Application-to-database communication
- ☁️ Cloud-based application deployment

Understanding LAMP also provides a solid foundation for modern cloud and DevOps practices.

---

## 🏗️ Architecture Overview (Two-Tier Design)

### Architecture Concept
This project follows a **two-tier architecture**:

- **Web Tier (Public Subnet)**
  - EC2 instance running Apache and PHP
  - Receives HTTP requests from users
  - Exposed to the internet via Internet Gateway

- **Database Tier (Private Subnet)**
  - EC2 instance running MySQL (MariaDB)
  - No public IP
  - Accessible only from the Web tier

### Networking Components
- Custom VPC with CIDR planning
- Public and private subnets
- Internet Gateway for inbound internet access
- NAT Gateway for outbound access from private subnet
- Route tables to control traffic flow
- Security Groups acting as firewalls

This design reflects **real-world cloud security best practices** by isolating sensitive resources.

---

## 🖼️ Architecture Diagram
The diagram below represents the logical architecture implemented in this project and explains how traffic flows between components.

![AWS LAMP Two-Tier Architecture](architecture/two-tier-lamp-architecture.png)

---

## 🔄 Request Flow (End-to-End)
1. User sends an HTTP request from a browser  
2. Request reaches Apache on the Web EC2 instance  
3. PHP processes the request  
4. PHP connects to MySQL using the private IP  
5. MySQL returns data to PHP  
6. PHP sends the response back to the user  

This confirms proper connectivity across network layers.

---

## 🛠️ Tools & Technologies Used
- ☁️ AWS EC2 (Amazon Linux)
- 🌐 AWS VPC (Subnets, Route Tables, IGW, NAT Gateway)
- 🌐 Apache (httpd)
- 🐘 PHP
- 🛢️ MySQL (MariaDB)
- 🔐 AWS Security Groups
- 🐧 Linux (Shell & Server Administration)
- 🔧 Git & GitHub

---

## ⚙️ Setup & Configuration Summary

### 1️⃣ Networking Setup
- Created a custom VPC with proper CIDR planning
- Configured public and private subnets
- Attached Internet Gateway and NAT Gateway
- Configured route tables for controlled traffic flow

### 2️⃣ EC2 Setup
- Launched Web EC2 instance in public subnet
- Launched Database EC2 instance in private subnet
- Assigned appropriate security groups

### 3️⃣ Web Server Setup
- Installed Apache (httpd)
- Installed PHP and required extensions
- Verified Apache and PHP functionality

### 4️⃣ Database Setup
- Installed MySQL (MariaDB)
- Secured MySQL installation
- Created database, tables, and a restricted DB user

### 5️⃣ Application Deployment
- Deployed PHP application
- Configured database connectivity
- Tested CRUD operations

---

## 🔐 Security Practices Implemented
- Database EC2 has **no public IP**
- MySQL access restricted to Web Security Group only
- Least-privilege database user created
- SSH access restricted and used temporarily
- Proper file permissions for web application
- Network isolation using public and private subnets

These practices align with **real-world cloud security standards**.

---

## ✅ Verification & Testing
The following validations were performed:
- Apache accessible via browser
- PHP execution verified
- MySQL service running
- PHP to MySQL connectivity tested
- Data insert, update, delete, and fetch operations verified
- Private subnet isolation confirmed

---

## 🚧 Challenges Faced & How I Resolved Them

🔹 **SSH Key Permission Error**  
Issue: SSH connection failed due to insecure private key permissions  
Solution: Corrected key permissions using `chmod 400 lamp-keyy.pem`

🔹 **SSH Access Worked with 0.0.0.0/0 but Not with My IP**  
Issue: SSH connection failed when restricted to my public IP  
Solution: Temporarily allowed 0.0.0.0/0 to debug, verified connectivity, and understood source IP handling in Security Groups

🔹 **HTTP vs HTTPS Access Issue**  
Issue: Website not accessible using HTTPS  
Solution: Verified Apache was configured only for HTTP (port 80) and accessed the application using HTTP

🔹 **Website Not Reachable from Browser**  
Issue: Apache was running but the site did not load in the browser  
Solution: Fixed missing HTTP (port 80) inbound rule in the Web Security Group

🔹 **PHP Not Executing Issue**  
Issue: PHP files were downloading instead of executing  
Solution: Installed missing PHP packages and MySQL PHP driver, then restarted Apache

🔹 **Private Database Connectivity Issue**  
Issue: PHP application could not connect to the MySQL database  
Solution: Configured Security Group–to–Security Group rule allowing port 3306 from Web EC2 to DB EC2

🔹 **Private Subnet Internet Access Issue**  
Issue: Database EC2 could not access the internet for package installation  
Solution: Created a NAT Gateway and updated the private route table

🔹 **File Permission Issue in Web Directory**  
Issue: Apache could not read PHP files properly  
Solution: Updated file permissions under `/var/www/html`

---

## 🧠 Key Learnings
- Designing secure two-tier cloud architecture
- Importance of subnet isolation
- Difference between Security Groups and NACLs
- Real-world cloud debugging approach
- Application and infrastructure dependency

---

## 🧾 Conclusion
This project provided hands-on experience in building and operating a secure two-tier LAMP stack on AWS.  
It reflects a production-style approach to cloud infrastructure rather than a simple tutorial-based setup.

---

## 👩‍💻 Author
**Shikha Mathur**  
Aspiring Cloud & DevOps Engineer
