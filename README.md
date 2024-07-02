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
