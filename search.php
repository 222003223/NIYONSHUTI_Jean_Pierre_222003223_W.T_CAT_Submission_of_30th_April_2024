<?php
require_once "databaseconnection.php";

if (isset($_GET['query'])) {
    $searchTerm = $connection->real_escape_string($_GET['query']);
    $output = "";

    $queries = [
        'bank' => "SELECT bank_id, bank_name, location, website, contact, bank_account, club_id FROM bank WHERE bank_id LIKE '%$searchTerm%'",
        'coacher' => "SELECT last_name, first_name, email, nationality, contact, club_id FROM coacher WHERE coacher_id LIKE '%$searchTerm%'",
        'user_admin' => "SELECT coacher_id,last_name, first_name, email, password, contact, Manager_id, username FROM user_admin WHERE user_id LIKE '%$searchTerm%'",
        'player' => "SELECT playeer_id, last_name, first_name, email, contact, position, country, club_id, date_of_birth FROM player WHERE playeer_id LIKE '%$searchTerm%'",
        'manager' => "SELECT manager_id, last_name, first_name, email, contact, club_id FROM manager WHERE manager_id LIKE '%$searchTerm%'",
        'club' => "SELECT club_id, name, city, league, stadium_name, league_id FROM club WHERE club_id LIKE '%$searchTerm%'",
        'matchs' => "SELECT match_id, match_date, home_club, away_club, referee_names FROM matchs WHERE match_id LIKE '%$searchTerm%'",
        'stadium' => "SELECT stadium_id, stadium_name, capacity, club_id FROM stadium WHERE stadium_id LIKE '%$searchTerm%'",
        'league' => "SELECT league_id, league_name, country, season, start_date, end_date, number_club FROM league WHERE league_id LIKE '%$searchTerm%'",
        'funclub' => "SELECT funclub_id, name, description, contact, website, club_id FROM fun_club WHERE funclub_id LIKE '%$searchTerm%'"
    ];

    echo "<h2><u>Search Results:</u></h2>";

    foreach ($queries as $table => $sql) {
        $result = $connection->query($sql);
        $output .= "<h3>Table of $table:</h3>";
        
        if ($result) {
            if ($result->num_rows > 0) {
                $output .= "<ul>";
                while ($row = $result->fetch_assoc()) {
                    $output .= "<li>";
                    foreach ($row as $key => $value) {
                        $output .= "$key: $value, ";
                    }
                    $output .= "</li>";
                }
                $output .= "</ul>";
            } else {
                $output .= "<p>No results found in $table matching the search term: '$searchTerm'</p>";
            }
        } else {
            $output .= "<p>Error executing query: " . $connection->error . "</p>";
        }
    }

    echo $output;

    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}
?>

