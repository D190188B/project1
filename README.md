# README for Snort Project

## Project Title: Hardening Web Server Against DDoS Attacks Using Snort IPS

### Overview
This project aims to protect a web server from Distributed Denial of Service (DDoS) attacks using Snort, an open-source Intrusion Detection and Prevention System (IDS/IPS). Specifically, the project focuses on mitigating ICMP-based DDoS attacks by filtering and dropping malicious ICMP packets.

### Files Included
- `snort.conf`: The main configuration file for Snort.
- `local.rules`: Custom Snort rules for detecting and blocking specific types of traffic.
- `alert`: The file where Snort logs alerts.

### System Setup
1. **Virtual Machines**:
   - **Attacker VM**: Running Windows OS to simulate DDoS attacks.
   - **Snort VM**: Running Debian OS, configured to act as the protective barrier.

2. **Network Configuration**:
   - The Snort VM has two network interfaces: one for internal communication with the attacker VM and another for external network access.
   - IP forwarding and Network Address Translation (NAT) are enabled on the Snort VM to route traffic appropriately.
  
- ### Installation Steps
1. **Install Snort**:
   ```bash
   sudo apt-get update
   sudo apt-get install snort

2. **Install Necessary Tools**:
   ```bash
   sudo apt-get install wireshark iptables

3. **Configuration Files**:
"snort.conf"
The snort.conf file is the main configuration file for Snort. Key configurations include:
   - Network Variables: Define the network segments that Snort will monitor.
   - Preprocessors: Configure additional processing steps for analyzing traffic.
   - Rule Paths: Specify the paths to rule files, including local.rules.
   ```bash
   # Set the network variables
   var HOME_NET 192.168.1.0/24
   var EXTERNAL_NET any
   
   # Include rule files
   include /etc/snort/rules/local.rules

"local.rules"
The local.rules file contains custom rules for Snort. These rules are designed to detect and block specific types of traffic, such as ICMP flood attacks and access to certain websites.

Example rules:
```bash
   # Set the network variables
   var HOME_NET 192.168.1.0/24
   var EXTERNAL_NET any
   
   # Include rule files
   include /etc/snort/rules/local.rules
```

"local.rules"
