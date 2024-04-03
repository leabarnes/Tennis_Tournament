<html>
    <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </head>
    <body>
        <h3>Simulate Tournament Listed Players</h3><br/>
        <form action="">
            <p>Player List (JSON)</p>
            <textarea id="player_list" style="width: 795px; height: 134px;">
[{"name":"Test 0","gender":"M","handicap":24,"extra":{"force":9,"velocity":4,"reaction":0}},
{"name":"Test 1","gender":"M","handicap":11,"extra":{"force":10,"velocity":8,"reaction":0}},
{"name":"Test 2","gender":"M","handicap":74,"extra":{"force":3,"velocity":1,"reaction":0}},
{"name":"Test 3","gender":"M","handicap":80,"extra":{"force":2,"velocity":3,"reaction":0}},
{"name":"Test 4","gender":"M","handicap":99,"extra":{"force":5,"velocity":5,"reaction":0}},
{"name":"Test 5","gender":"M","handicap":97,"extra":{"force":1,"velocity":10,"reaction":0}},
{"name":"Test 6","gender":"M","handicap":90,"extra":{"force":3,"velocity":8,"reaction":0}},
{"name":"Test 7","gender":"M","handicap":64,"extra":{"force":10,"velocity":7,"reaction":0}}]</textarea>
        </form><br/>
        <a href="#" onclick="simulateList()">Simulate</a><br/>

        <h3>Simulate Tournament</h3><br/>
        <p>Num. Players</p>
        <input id="num_players">
        <p>Gender</p>
        <input id="gender">
        <p>Random <input id="random" type="checkbox"></p>
        <a  href="#" onclick="simulate()">Simulate </a><br/>
    </body>
    <script>
        function simulateList(){
            var list = JSON.parse($("#player_list").val());
            $.ajax({
                method: "POST",
                url: "/api/simulate.php",
                data: { player_list: list }
            }).done(function( msg ) {
                alert( "Winner: " + msg );
            });
        }
        function simulate(){
            var num_players = $("#num_players").val();
            var gender = $("#gender").val();
            var random = $("#random").checked;
            $.ajax({
                method: "POST",
                url: "/api/simulate.php",
                data: { num_players: num_players, gender: gender, random: random }
            }).done(function( msg ) {
                alert( "Winner: " + msg );
            });
        }
    </script>
</html>