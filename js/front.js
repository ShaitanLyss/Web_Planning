// checkbox dark mode
let body = document.querySelector('body')
let darkModeToggle = document.querySelector('input#dark-mode-toggle')
const darkModeToggleCB = e => {
	if (darkModeToggle.checked) {
		body.classList = ['dark']
	} else {
		body.classList = ['light']
	}
}
darkModeToggle.addEventListener('click', darkModeToggleCB)

// checkbox custom game system
let customSystemToggle = document.querySelector('input#custom-system-toggle')
let gameSystemSelect = document.querySelector('select#game-system-select')
let customSystemName = document.querySelector('input#custom-system-name')
customSystemName.hidden = true
const customSystemToggleCB = e => {
	if (customSystemToggle.checked) {
		gameSystemSelect.hidden = true
		customSystemName.hidden = false
	} else {
		gameSystemSelect.hidden = false
		customSystemName.hidden = true
	}
}
customSystemToggle.addEventListener('click', customSystemToggleCB)

// set min date to today
let dateInput = document.querySelector('input#date-input')
dateInput.min = new Date().toISOString().slice(0, 10)

// save form on discord connection link
let newGameForm = document.querySelector('form#new-game-form')
let discordLink = document.querySelector('a#discord-connect-link')
discordLink.addEventListener('click', e => {
	e.preventDefault()
	let fd = new FormData(newGameForm)
	let fdData = {};
	for (let [key, value] of fd) {
		fdData[key] = value
	}
	localStorage.setItem('UR-newGameForm', JSON.stringify(fdData))
	document.location = discordLink.href
})

// populate form on page load
let fd = JSON.parse(localStorage.getItem('UR-newGameForm'))
if (!!fd && fd['dark-mode-toggle'] === undefined) {
	fd['dark-mode-toggle'] = false
}
for (const key in fd) {
	const field = document.querySelector(`form#new-game-form [name="${key}"]`)
	if (field.type === 'checkbox') {
		field.checked = fd[key] === 'on'
	} else if (field.type === 'radio') {
		document.querySelector(`form#new-game-form [name="${key}"][value="${fd[key]}"]`).checked = true
	} else {
		field.value = fd[key]
	}
}
customSystemToggleCB()
darkModeToggleCB()

// clear storage on form submit
newGameForm.addEventListener('submit', e => {
	localStorage.clear()
})
