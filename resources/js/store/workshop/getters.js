export const workshop = (state, getters) => {
  return state.workshop
}
export const availableDecks = (state, getters) => {
  return state.availableDecks
}
export const baseUrl = (state, getters) => {
  return state.baseUrl
}
export const user = (state, getters) => {
  return state.user
}
export const isAuthorOfWorkshop = (state, getters) => {
  return state.isAuthorOfWorkshop
}
export const workshopBaseUrl = (state, getters) => {
  return state.workshopBaseUrl
}


//   ______
//  /_  __/__  ____ _____ ___
//   / / / _ \/ __ `/ __ `__ \
//  / / /  __/ /_/ / / / / / /
// /_/  \___/\__,_/_/ /_/ /_/

export const teams = (state, getters) => {
  return state.teams;
}

export const selectedTeam = (state, getters) => {
  return state.selectedTeam;
}

export const allTeamPlayers = (state, getters) => {

	var allTeamPlayers = [];
	var teams = getters.teams;

	for (var i = 0; i < teams.length; i++) {
		for (var u = 0; u < teams[i].players.length; u++) {
			allTeamPlayers.push(teams[i].players[u]);
		}
	}

	return allTeamPlayers;
}

export const participants = (state, getters) => {
	return state.participants;
}

export const participantsWithoutTeam = (state, getters) => {
	var allTeamPlayers = Array.from(getters.allTeamPlayers);
	var participants = getters.participants;
	var participantsWithoutTeam = [];

	if(participants != null && allTeamPlayers != null){
		for (var i = 0; i < participants.length; i++) {
			
			var indexFounded = allTeamPlayers.findIndex(function(element){
				return element.id == participants[i].id;
			});

			if(indexFounded < 0){
				participantsWithoutTeam.push(participants[i]);
			}
			
		}
		console.log(participantsWithoutTeam)
	}

	return participantsWithoutTeam;
}
