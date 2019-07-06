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
}

// function setWorkshop (state, data) {
// 	state.workshop = data;
// }