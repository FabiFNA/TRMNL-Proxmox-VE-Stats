# TRMNL Proxmox VE Stats Plugin

This plugin allows you to display Proxmox VE resource statistics (CPU, RAM, Disk, Uptime) inside TRMNL by polling a simple HTTP endpoint exposed by your Proxmox host.

It is designed to work with TRMNL’s polling mechanism and a custom Blade view.

<img width="800" height="480" alt="example" src="https://github.com/user-attachments/assets/d281598c-cea7-4a0c-b207-9ef6851029ad" />


---

## Overview

The plugin retrieves system statistics from your Proxmox VE server via a JSON endpoint and renders them inside TRMNL.

Displayed metrics:

- CPU usage (%)
- RAM usage (%)
- Disk usage (%)
- Uptime (days)
- Last update time

---

## Requirements

- A running Proxmox VE host
- A reachable HTTP/HTTPS endpoint on your Proxmox server
- TRMNL configured with a polling URL
- Network access from TRMNL to your Proxmox server

---

## Step 1 – Configure Proxmox

Before using this plugin, you must expose a status endpoint on your Proxmox server.

Example polling URL:

```

https://{ip-or-domain-of-your-proxmox}/status

````

This endpoint must return JSON data containing at least:

```json
{
  "cpu": 23,
  "ram": 61,
  "disk": 48,
  "uptime_days": 12
}
````

How you implement this endpoint is up to you. Common approaches:

* A small web server (nginx, Apache, etc.) serving a generated JSON file
* A custom API endpoint
* A script that queries Proxmox (for example via `pvesh` or the Proxmox API) and outputs JSON
* A reverse proxy mapping `/status` to an internal stats script

Important:

* Ensure the endpoint is accessible from the TRMNL device.
* If using HTTPS with a self-signed certificate, make sure TRMNL can access it.
* Consider authentication or network restrictions for security.

---

## Step 2 – Configure TRMNL

In TRMNL, configure the plugin to use the following Polling URL:

```
https://{ip-or-domain-of-your-proxmox}/status
```

TRMNL will periodically request this endpoint and pass the JSON response into the Blade template as `$data`.

The template expects the following keys:

* `cpu`
* `ram`
* `disk`
* `uptime_days`

If a key is missing, the display will fall back to `N/A`.

---

## Data Format

All percentage values should be numeric (without the `%` sign).
Example:

```json
{
  "cpu": 45,
  "ram": 72,
  "disk": 51,
  "uptime_days": 4
}
```

The template automatically:

* Adds the percent symbol
* Adjusts progress bar width
* Displays the last update time

---

## Security Considerations

Do not expose sensitive system information publicly.

Recommended approaches:

* Restrict access by IP
* Use firewall rules
* Place the endpoint behind a VPN
* Use authentication if exposed beyond your local network

---

## Troubleshooting

If no data appears in TRMNL:

1. Open the polling URL in a browser.
2. Verify that valid JSON is returned.
3. Confirm that TRMNL can reach the Proxmox host.
4. Check firewall and certificate configuration.

---

## Summary

1. Expose a JSON endpoint on Proxmox at:

   ```
   https://{ip-or-domain-of-your-proxmox}/status
   ```

2. Configure TRMNL to poll that URL.

3. Ensure the JSON format matches the expected keys.

4. Verify network access and security settings.

Once configured correctly, TRMNL will automatically display live Proxmox VE statistics.

