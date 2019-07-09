// import Vue from 'vue'

export default {
	setWorkshop (state, data) {
		state.workshop = data;
	},
	setAvailableDecks (state, data) {
		state.availableDecks = data;
	},
	setWorkshopDeck (state, data) {
		state.workshop.deck = data;
		state.workshop.deck_id = data.id;
	},
	setUser (state, data) {
		state.user = data;
	},
	setAuthorRights (state, data) {
		state.isAuthorOfWorkshop = data;
	},
	setTeams (state, data) {
		state.teams = data;
	},
}

// function setWorkshop (state, data) {
// 	state.workshop = data;
// }