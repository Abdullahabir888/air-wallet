const chart = document.querySelector("#chart").getContext("2d")

// Create a new chart instance
new Chart(chart, {
  type: "line",
  data: {
    labels: ["jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov"],

    datasets: [
      {
        label: "BTC",
        data: [29374, 33537, 49631, 59095, 57828, 36684, 33572, 39974, 48847, 48116, 61004],
        borderColor: "red",
        borderWidth: 2,
      },
      {
        label: "ETH",
        data: [31500, 41000, 88800, 26000, 46000, 32698, 5000, 3000, 18768, 24832, 36844],
        borderColor: "blue",
        borderWidth: 2,
      },
    ],
  },
  options: {
    responsive: true,
  },
})

// show or hide sidebar
const menuBtn = document.querySelector("#menu-btn")
const closeBtn = document.querySelector("#close-btn")
const sidebar = document.querySelector("aside")

menuBtn.addEventListener("click", () => {
  sidebar.style.display = "block"
})

closeBtn.addEventListener("click", () => {
  sidebar.style.display = "none"
})

// change theme
const themeBtn = document.querySelector(".theme-btn")

themeBtn.addEventListener("click", () => {
  document.body.classList.toggle("dark-theme")

  themeBtn.querySelector("span:first-child").classList.toggle("active")

  themeBtn.querySelector("span:last-child").classList.toggle("active")
})

// Wallet balance deduction
// all cards
const cards = document.querySelectorAll(".cards .card")
// active previously active card
const activeCardId = parseInt(localStorage.getItem("card"))

if (activeCardId || activeCardId === 0) {
  const prevActiveCard = cards[activeCardId]
  const prevActiveCardActive = prevActiveCard.querySelector(".active")
  const spanEl = document.createElement("span")
  spanEl.classList.add("badge")
  spanEl.textContent = "Active"
  prevActiveCardActive.appendChild(spanEl)
}

cards.forEach((card, index) => {
  card.addEventListener("click", () => activeCard(cards, index))
})

// restore card amount from local storage
const localStorageAmount = {
  card_0: localStorage.getItem("card_0"),
  card_1: localStorage.getItem("card_1"),
  card_2: localStorage.getItem("card_2"),
}
localStorageAmount1 = localStorage.getItem("card_1")
localStorageAmount2 = localStorage.getItem("card_2")
// card amount
const cardsAmount = document.querySelectorAll(".cards .card .amount")
cardsAmount.forEach((amount, index) => {
  amount.textContent = localStorageAmount[`card_${index}`] || amount.textContent
})

// active card
const activeCard = (cards, id) => {
  const activeCardId = parseInt(localStorage.getItem("card"))
  if (activeCardId || activeCardId === 0) {
    const activeCard = cards[activeCardId]
    const activeCardActive = activeCard.querySelector(".active")
    activeCardActive.innerHTML = ""
  }

  const card = cards[id]
  const cardActive = card.querySelector(".active")
  const spanEl = document.createElement("span")
  spanEl.classList.add("badge")
  spanEl.textContent = "Active"
  cardActive.appendChild(spanEl)
  localStorage.setItem("card", id)
}
// badges Element
const badgesEl = document.querySelector(".badges")
const badges = [
  {
    name: "Training",
    amount: 50,
    color: "bg-primary",
  },
  {
    name: "Internet",
    amount: 40,
    color: "bg-success",
  },
  {
    name: "Gas",
    amount: 190,
    color: "bg-primary",
  },
  {
    name: "Movies",
    amount: 35,
    color: "bg-danger",
  },
  {
    name: "Education",
    amount: 999,
    color: "bg-primary",
  },
  {
    name: "Electricity",
    amount: 109,
    color: "bg-danger",
  },
  {
    name: "Food",
    amount: 399,
    color: "bg-success",
  },
]

const parseAmount = amount => parseInt(amount.replace(/[^0-9]/g, ""))

const makeAmount = amount => `$${amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}`

const createBadges = (badgesEl, badges) => {
  badges.forEach(badge => {
    const badgeEl = document.createElement("div")
    badgeEl.classList.add("badge")
    const badgeSpanEl = document.createElement("span")
    badgeSpanEl.classList.add(badge.color)
    const badgeDivEl = document.createElement("div")
    const badgeNameEl = document.createElement("h5")
    badgeNameEl.textContent = badge.name
    const badgeAmountEl = document.createElement("h4")
    badgeAmountEl.textContent = badge.amount
    // append badgeNameEl in badgeDivEl
    badgeDivEl.appendChild(badgeNameEl)
    // append badgeAmountEl in badgeDivEl
    badgeDivEl.appendChild(badgeAmountEl)
    // append badgeSpanEl in badgeEl
    badgeEl.appendChild(badgeSpanEl)
    // append badgeDivEl in badgeEl
    badgeEl.appendChild(badgeDivEl)
    // on click badgeEl
    badgeEl.addEventListener("click", () => {
      let activeCardId = parseInt(localStorage.getItem("card"))
      if (activeCardId === null) {
        activeCardId = 0
        cardActive(cards, activeCardId)
      }
      if (confirm("Are you sure?")) {
        // deduct amount from card
        const newAmount = parseAmount(cardsAmount[activeCardId].textContent) - badge.amount
        cardsAmount[activeCardId].textContent = makeAmount(newAmount)
        // save new card amount in local storage
        localStorage.setItem(`card_${activeCardId}`, makeAmount(newAmount))
      }
    })
    // append badgeEl in badgesEl
    badgesEl.appendChild(badgeEl)
  })
}
createBadges(badgesEl, badges)
