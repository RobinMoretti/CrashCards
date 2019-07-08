import Vuex from 'vuex';
import Vue from 'vue'

import mutations from './mutations'
import actions from './actions'
import * as getters from './getters'

Vue.use(Vuex)

export default new Vuex.Store({
	state: {
		workshop: { 
			"id": null, 
			"name": null,
			"index": null,
			"locked": 0,
			"author_id": 1,
			"deck_id": null,
			"created_at": null,
			"updated_at": null,
			"description": null,
			"start_date": null,
			"end_date": null,
			"image_header": null,
			"author": { 
				"id": null,
				"name": null,
				"username": null,
				"email": null,
				"email_verified_at": null,
				"created_at": null,
				"updated_at": null 
			}
		},
		user: { 
			"id": null, 
			"name": null,
			"username": null,
			"author": false,
		},
		availableDecks: [],
		baseUrl: document.getElementById("site-base-url").textContent
	},
	mutations,
	getters,
	actions,
	strict: true
})