

<style>

@import "tailwindcss";

@source "../../vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php";
@source "../../storage/framework/views/*.php";
@source "../**/*.blade.php";
@source "../**/*.js";


h1, h3 {
    font-size: 20;
    font-weight: bold;
    width: fit-content;
    margin: 0 auto;
}

h3 {
    font-size: 14;
}

table {
    width: fit-content;
}

th, td {
    padding: 5px 10px;
}

.main_container_up,
.main_container_down {
    display: flex;
    flex-direction: row;
}

.container_table {
display: flex; 
flex-direction: column;
width: 50%;
}

#copy_button {
    margin: 2% 0 2% 2%;
    background-color: lightgray;
    padding: 1%;
}

.center, 
.season_selection {
    display: flex;
    justify-content: center;
    padding: 2%;
}

.center {
    flex-direction: column;
}

.container_form_player {
    margin: 0 auto;
}

.season_selection {
    width: fit-content;
    margin: 0 auto;
}

#profile_img {
    max-width: 200px;
    height: auto;
    margin: 3% auto 0;
}

.hidden-file-input {
  position: absolute;
  opacity: 0;
  width: 0;
  height: 0;
  overflow: hidden;
}

#upload_btns {
    display: block;
}
 
/* Style the custom button (label) */
.upload-file-button {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 10px 20px;
  background: #F97316;
  color: #FDE047;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-family: Arial, sans-serif;
  font-size: 14px;
  transition: background 0.3s;
}

.orange_team_dot,
.yellow_team_dot {
    display: flex;
    width: 20px;
    border-radius: 50%;
    height: 20px;
    background-color: orange;
}

.yellow_team_dot {
    background-color: #eded08f0;
}

 #chart_team {
    width: 200px;
    height: auto;
}

.player_img_name {
margin-left: 5%;
align-content: center;
}

.container_activity {
   display: flex;
   justify-content: center;
   margin: 1%;
}

.user_activity {
   align-content: center;
}

#ball {
   margin-left: 5px;
}

.team_picture_login {
    max-width: 500px;
    height: auto;
    border-radius: 50%;
    margin: 2% auto 0;
}

.logout {
    position:absolute;
    right: 0;
    margin-right: -35%; 
    cursor: pointer;
   }


</style>