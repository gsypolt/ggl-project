// Define the number of teams, rounds, and delay per pick
const numTeams = 10;
const numRounds = 5;
const delayPerPick = 250;

// Define the teams and their initial draft positions
const teams = [
  { name: 'Whiskey Warriors', position: 1, weight: 70 },
  { name: 'Black Rhinos', position: 2, weight: 10 },
  { name: 'Evil Engineers', position: 3, weight: 7 },
  { name: 'Chieftains', position: 4, weight: 5 },
  { name: 'Gorilla Warfare Klan', position: 5, weight: 2 },
  { name: 'Loco Bandidos', position: 6, weight: 1 },
  { name: 'The Guardians', position: 7, weight: 0.75 },
  { name: 'Redskins Nation', position: 8, weight: 0.5 },
  { name: 'Buck Hunters', position: 9, weight: 0.25 },
  { name: 'Knockout Kings', position: 10, weight: 0.5 }
];

// Create an array to store the draft order
let draftOrder = [];

// Function to reset the draft order
function resetDraftOrder() {
  draftOrder = [];
}

// Function to perform a weighted draft for a round
function weightedDraft(round) {
  const weightedLottery = teams.flatMap((team) => {
    return Array(Math.floor(team.weight * 10)).fill(team.position);
  });

  const roundPicks = [];

  for (let i = 0; i < numTeams; i++) {
    const team = teams[i];

    let pick;
    if (team.position === 1) {
      pick = weightedLottery.splice(
        Math.floor(Math.random() * weightedLottery.length),
        1
      )[0];
      roundPicks.push(pick);
    } else {
      const eligiblePicks = weightedLottery.filter(
        (p) => Math.abs(p - team.position) <= 2 && !roundPicks.includes(p)
      );
      pick = eligiblePicks[Math.floor(Math.random() * eligiblePicks.length)];
      roundPicks.push(pick);
    }

    draftOrder.push(pick);
    console.log(`Round ${round}, Pick ${i + 1}: ${team.name}`);
    updateDraftResultsTable();
  }
}

// Function to run the draft
function runDraft() {
  resetDraftOrder();

  for (let round = 1; round <= numRounds; round++) {
    setTimeout(function () {
      weightedDraft(round);
      if (round === numRounds) {
        console.log('The draft lottery is complete!');
      }
    }, (round - 1) * delayPerPick * numTeams);
  }
}

// Function to update the draft results table in the HTML
function updateDraftResultsTable() {
  const tableBody = document.getElementById('draft-results-body');
  tableBody.innerHTML = '';

  draftOrder.forEach((pick, index) => {
    const round = Math.floor(index / numTeams) + 1;
    const pickNumber = (index % numTeams) + 1;

    let teamName;
    if (pick <= numTeams) {
      const team = teams.find((t) => t.position === pick);
      teamName = team ? team.name : '';
    } else {
      const reversePick = (2 * numTeams) - pick;
      const team = teams.find((t) => t.position === reversePick + 1);
      teamName = team ? team.name : '';
    }

    const row = `<tr>
                  <td>${round}</td>
                  <td>${pickNumber}</td>
                  <td>${teamName}</td>
                </tr>`;
    tableBody.innerHTML += row;
  });
}
