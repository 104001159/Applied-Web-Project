<!DOCTYPE html>
<html lang = "en">
    <head>
        <?php include 'header.inc'; ?>
        <meta name="description" content="Meet the CartX Group 5 development team. Learn about each member's contributions to the project across Part 1 and Part 2.">
        <meta name="keywords" content="about us, team, contributions">
        <meta name="author" content="Tom Holliday" >
        <title>About Our Team</title>
        <style>
            table {
                width: 25%;
            }
            tbody :hover{
                background-color: #c4aadf;
            }
        </style>
    </head>
    <body>
        <header>
            <h1>About Us</h1>
        </header>

        <nav>
            <p class="menu"><a href="index.php">Home</a></p>
            <p class="menu"><a href="jobs.php">Jobs</a></p>
            <p class="menu"><a href="apply.php">Apply</a></p>
            <p class="menu"><a href="about.php">About Us</a></p>
            <p class="menu" style="float: right;"><a href="loginpage.php">Manager Login</a></p>
        </nav>

        <fieldset>
            <h2>
                Group 5
            </h2>
            <ul style = "list-style: none;">
                <li>
                    <h3>Thursday</h3>
                    <ul style = "list-style: none;">
                        <li>
                            <h4>4:30</h4>
                        </li>
                    </ul>
                </li>
                <li>
                    <figure>
                        <img src="images/group_image.webp" alt="The CartX Team" loading="lazy" class="group_image">
                        <figcaption>The CartX Team</figcaption>
                    </figure>
                </li>
            </ul>
        </fieldset>

        <fieldset>
            <h2>
                Kavish - 104001159
            </h2>
                <?php
                    require_once "settings.php";
                    $result = mysqli_query($conn, "SELECT contribution_area, contribution_detail FROM about WHERE student_id = '104001159' ORDER BY project_part ASC");
                    if ($result && mysqli_num_rows($result) > 0) {
                        echo "<dl>";
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<dt>" . htmlspecialchars($row['contribution_area']) . "</dt>";
                            echo "<dd>" . htmlspecialchars($row['contribution_detail']) . "</dd>";
                        }
                        echo "</dl>";
                    }
                ?>
            <p lang =""> <em>எண்ணம் போல் வாழ்வு</em> (Translation: Perception drives Reality)</p>
            <table>
                <caption>Fun Facts about Kavish</caption>
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">1st</th>
                        <th scope="col">2nd</th>
                        <th scope="col">3rd</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Favourite Coding Snacks</th>
                        <td>Chocolates</td>
                        <td>Tim Tams</td>
                        <td>Pepsi Max</td>
                    </tr>
                    <tr>
                        <th>Dream Jobs</th>
                        <td>Software Engineer</td>
                        <td>Product Manager</td>
                        <td>Data Scientist</td>
                    </tr>
                    <tr>
                        <th>Dream Vacations</th>
                        <td>Japan</td>
                        <td>Maldives</td>
                        <td>Europe</td>
                    </tr>
                    <tr>
                        <th>Other Fun Facts</th>
                        <td>I love Cricket</td>
                        <td>I have never broken a bone</td>
                        <td>I taught myself to play the guitar</td>
                    </tr>
                </tbody>
            </table>
        </fieldset>

        <fieldset>
            <h2>
                YuKit - 106409878
            </h2>
                <?php
                    $result = mysqli_query($conn, "SELECT contribution_area, contribution_detail FROM about WHERE student_id = '106409878' ORDER BY project_part ASC");
                    if ($result && mysqli_num_rows($result) > 0) {
                        echo '<dl style="color: #7b4fa6">';
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<dt>" . htmlspecialchars($row['contribution_area']) . "</dt>";
                            echo "<dd>" . htmlspecialchars($row['contribution_detail']) . "</dd>";
                        }
                        echo "</dl>";
                    }
                ?>
            <p lang ="zh-Hant"><em>星隕似箭劃萬裡 瞬芒終歸入萬空</em> (Translation: Shooting stars cut across vast distances like arrows
a brief flash and returns to the emptiness)</p>
            <table>
                <caption>Fun Facts about YuKit</caption>
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">1st</th>
                        <th scope="col">2nd</th>
                        <th scope="col">3rd</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Favourite Coding Snacks</th>
                        <td>Redbull Sugarfree</td>
                        <td>Redbull Sugarfree</td>
                        <td>Redbull Sugarfree</td>
                    </tr>
                    <tr>
                        <th>Dream Jobs</th>
                        <td>Backend programmer</td>
                        <td>Sole team dev</td>
                        <td>Data analyst</td>
                    </tr>
                    <tr>
                        <th>Dream Vacations</th>
                        <td>Taiwan</td>
                        <td>Tokyo</td>
                        <td>Iceland</td>
                    </tr>
                    <tr>
                        <th>Other Fun Facts</th>
                        <td>I got 10 console emulator on my pc right now</td>
                        <td>...</td>
                        <td>...</td>
                    </tr>
                </tbody>
            </table>
        </fieldset>

        <fieldset>
            <h2>
                Tom - 106501169
            </h2>
                <?php
                    $result = mysqli_query($conn, "SELECT contribution_area, contribution_detail FROM about WHERE student_id = '106501169' ORDER BY project_part ASC");
                    if ($result && mysqli_num_rows($result) > 0) {
                        echo "<dl>";
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<dt>" . htmlspecialchars($row['contribution_area']) . "</dt>";
                            echo "<dd>" . htmlspecialchars($row['contribution_detail']) . "</dd>";
                        }
                        echo "</dl>";
                    }
                    mysqli_close($conn);
                ?>
            <p lang ="fr"><em>Creér, c'est vivre deux fois</em> (Translation:To create is to live twice.) - Albert Camus</p>
            <table>
                <caption>Fun Facts about Tom</caption>
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">1st</th>
                        <th scope="col">2nd</th>
                        <th scope="col">3rd</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Favourite Coding Snacks</th>
                        <td>Tea</td>
                        <td>Raw Chickpeas</td>
                        <td>Gum</td>
                    </tr>
                    <tr>
                        <th>Dream Jobs</th>
                        <td>Malware Analyst</td>
                        <td>Pentester</td>
                        <td>Security Engineer</td>
                    </tr>
                    <tr>
                        <th>Dream Vacations</th>
                        <td>London</td>
                        <td>Seville</td>
                        <td>Marseille</td>
                    </tr>
                    <tr>
                        <th>Other Fun Facts</th>
                        <td>I support Arsenal</td>
                        <td>I own two cacti</td>
                        <td>I have never broken a bone</td>
                    </tr>
                </tbody>
            </table>
        </fieldset>

        <?php include 'footer.inc'; ?>
    </body>
</html>