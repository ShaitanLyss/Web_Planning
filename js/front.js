// checkbox dark mode
let body = document.querySelector('body')
let darkModeToggle = document.querySelector('input#dark-mode-toggle')
darkModeToggle.addEventListener('click', e => {
	if (darkModeToggle.checked) {
		body.classList = ['dark']
	} else {
		body.classList = ['light']
	}
})

// checkbox custom game system
let customSystemToggle = document.querySelector('input#custom-system-toggle')
let gameSystemSelect = document.querySelector('select#game-system-select')
let customSystemName = document.querySelector('input#custom-system-name')
customSystemName.hidden = true
customSystemToggle.addEventListener('click', e => {
	if (customSystemToggle.checked) {
		gameSystemSelect.hidden = true
		customSystemName.hidden = false
	} else {
		gameSystemSelect.hidden = false
		customSystemName.hidden = true
	}
})

// discord connection button
let discordConnectionButton = document.querySelector('button#discord-connect-btn')
let discordConnectionIframe = document.querySelector('iframe#discord-connect-iframe')
discordConnectionIframe.hidden = true
discordConnectionButton.addEventListener('click', e => {
	if (discordConnectionIframe.hidden) {
		discordConnectionIframe.hidden = false
	} else {
		discordConnectionIframe.hidden = true
	}
})
