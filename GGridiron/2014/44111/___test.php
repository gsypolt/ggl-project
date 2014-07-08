<?php
require_once 'core.php';
//header('Content-Type: application/json');
echo '<h2>TESTING</h2><hr>';
$start_time = time();
//get_last_pick_id();
//echo json_encode(get_current_pick_details()).'<BR>';//update_draft_results();
//echo json_encode(get_draft_results());
//update_league_db();
//update_players_db();
//update_injuries_db();
//update_roster_players_db();
//create_player_scores_table();
//update_player_scores_db(21445,2013);
update_draft_results_db();
update_free_agents_db();


//print_r(get_player_scores());

////print_r(get_roster_players("0009"));
//echo "<hr>";
//print_r(get_league());
//echo "<hr>";
//print_r(get_divisions());
//echo "<hr>";
//print_r(get_franchises());
//cho "<hr>";
//print_r(get_mfl_player_scores());
//echo "<hr>";

$finish_time = time();
$time_diff = $finish_time - $start_time;
echo "<h3>Took: $time_diff second(s)</h3><br>";

echo "<hr><h2>COMPLETE</h2>";