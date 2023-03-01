let score = 0;
let clickBonus = 1;
let clickBonusCost = 50;
let autoClickers = 0;
let autoClickerCost = 10;

const scoreElement = document.getElementById("score");
const clickerButton = document.getElementById("clicker");
const buyAutoClickerButton = document.getElementById("buyAutoClicker");
const buyClickBonusButton = document.getElementById("buyClickBonus");

clickerButton.addEventListener("click", () => {
  score += clickBonus;
  updateScore();
});

buyAutoClickerButton.addEventListener("click", () => {
  if (score >= autoClickerCost) {
    score -= autoClickerCost;
    autoClickers++;
    autoClickerCost *= 2;
    updateScore();
  }
});

buyClickBonusButton.addEventListener("click", () => {
  if (score >= clickBonusCost) {
    score -= clickBonusCost;
    clickBonus++;
    clickBonusCost *= 2;
    updateScore();
  }
});

setInterval(() => {
  score += autoClickers * clickBonus;
  updateScore();
}, 1000);

function updateScore() {
  scoreElement.textContent = score;
  buyAutoClickerButton.textContent = `acheter autocliker (prix ${autoClickerCost})`;
  buyClickBonusButton.textContent = `acheter Click Bonus (prix ${clickBonusCost})`;
}

window.addEventListener("beforeunload", () => {
  localStorage.setItem("clickerGameScore", score);
  localStorage.setItem("clickerGameAutoClickers", autoClickers);
  localStorage.setItem("clickerGameClickBonus", clickBonus);
  localStorage.setItem("clickerGameAutoClickerCost", autoClickerCost);
  localStorage.setItem("clickerGameClickBonusCost", clickBonusCost);
});

window.addEventListener("load", () => {
  score = parseInt(localStorage.getItem("clickerGameScore")) || 0;
  autoClickers = parseInt(localStorage.getItem("clickerGameAutoClickers")) || 0;
  clickBonus = parseInt(localStorage.getItem("clickerGameClickBonus")) || 1;
  autoClickerCost = parseInt(localStorage.getItem("clickerGameAutoClickerCost")) || 10;
  clickBonusCost = parseInt(localStorage.getItem("clickerGameClickBonusCost")) || 50;
  updateScore();
});
