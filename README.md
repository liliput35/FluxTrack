# FluxTrack - Incident Reporting Web App

FluxTrack is a PHP-based web application designed to report, monitor, and manage incidents within an organization.
It helps administrators and department staff track reported incidents, assign roles, update statuses, and maintain an organized record of reports.


<h2>🧩 System Overview</h2>

<p>
FluxTrack enables users to:
<ul>
<li>Report new incidents through an intuitive form.</li>
<li>Assign cases to specific roles (Housekeeping, Security, Engineering, Operations).</li>
<li>Update incident statuses (<b>Unresolved</b>, <b>Ongoing</b>, <b>Resolved</b>).</li>
<li>Track progress and view historical records.</li>
<li>Analyze trends and totals on a centralized dashboard.</li>
</ul>
</p>

<hr>

<h2>🚀 Core Features</h2>

<ul>
<li><b>Incident Management:</b> Create, edit, and resolve incidents with details like location, date/time, and remarks.</li>
<li><b>Dashboard Analytics:</b> Displays monthly totals, comparisons, and top incident types.</li>
<li><b>Role-Based Access:</b> Admins see all reports; roles (Housekeeping, Security, etc.) see only assigned incidents.</li>
<li><b>Real-Time Search:</b> AJAX-powered live search for instant filtering.</li>
<li><b>History Tracking:</b> “Resolved” incidents archive with date range summary.</li>
<li><b>User Authentication:</b> Secure login and session handling.</li>
</ul>

<hr>

<h2>🧱 Tech Stack</h2>

<ul>
<li><b>Frontend:</b> HTML5, CSS3, Bootstrap 5, JavaScript (AJAX)</li>
<li><b>Backend:</b> PHP 8 (Procedural, MySQLi)</li>
<li><b>Database:</b> MySQL</li>
<li><b>Server:</b> Apache (XAMPP)</li>
</ul>

<hr>
<h3>⚙️ Steps</h3>
<ol>
<li><b>Copy the project folder:</b><br>
Place the folder in your XAMPP directory:<br>
<code>C:\xampp\htdocs\FluxTrack</code></li><br>

<li><b>Start Apache and MySQL</b> via the XAMPP Control Panel.</li><br>

<li><b>Import the database files</b> in phpMyAdmin (in this order):<br>
<ol type="a">
<li><code>schema.sql</code> → Creates all database tables.</li>
<li><code>seed.sql</code> → Adds sample user accounts (Admin, Housekeeping, etc.).</li>
<li><code>incidents.sql</code> → Inserts sample incident reports.</li>
</ol>
</li><br>

<hr>

<h2>👥 Default Accounts</h2>

<table>
<tr><th>Name</th><th>Role</th><th>Username</th><th>Password</th></tr>
<tr><td>Julian Mapa</td><td>Admin</td><td>sirmapa</td><td>1234</td></tr>
<tr><td>Lorenz Ciocon</td><td>Security</td><td>lorenz</td><td>1234</td></tr>
<tr><td>Mia Chua</td><td>Housekeeping</td><td>mia</td><td>1234</td></tr>
</table>
