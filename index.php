<html>
    <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </head>
    <body>
        <h3>Simulate Tournament Listed Players</h3><br/>
        <form action="">
            <p>Player List (JSON)</p>
            <textarea id="player_list">
        </form><br/>
        <a onclick="simulateList()">Simulate</a><br/>

        <h3>Simulate Tournament</h3><br/>
        <p>Num. Players</p>
        <input id="num_players">
        <p>Gender</p>
        <input id="gender">
        <p>Random</p>
        <input id="random" type="checkbox">
        <a onclick="simulate()">Simulate </a><br/>
    </body>
    <script>
        function simulateList(){
            var list = $("#player_list").val;
            $.ajax({
                method: "POST",
                url: "/api/simulate.php",
                data: { player_list: list }
            })
        }
        function simulate(){
            var num_players = $("#num_players").val;
            var gender = $("#gender").val;
            var random = $("#random").checked;
            $.ajax({
                method: "POST",
                url: "/api/simulate.php",
                data: { num_players: num_players, gender: gender, random: random }
            })
        }
    </script>
</html>