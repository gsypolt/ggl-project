# Simple Draft Lottery App 

## Setup

* Open `draft.js` file
* Set the number of teams, rounds and delay per pick

```
const numTeams = 10;
const numRounds = 5;
const delayPerPick = 250;
```

* Edit team names based on draft lottery position

```
const teams = [
  { name: 'Gorilla Warfare Klan', position: 1, weight: 70 },
  { name: 'Loco Bandidos', position: 2, weight: 10 },
  { name: 'Chieftains', position: 3, weight: 7 },
  { name: 'Whiskey Warriors', position: 4, weight: 5 },
  { name: 'Buck Hunters', position: 5, weight: 2 },
  { name: 'Evil Engineers', position: 6, weight: 1 },
  { name: 'Black Rhinos', position: 7, weight: 0.75 },
  { name: 'The Guardians', position: 8, weight: 0.5 },
  { name: 'Redskins Nation', position: 9, weight: 0.25 },
  { name: 'Knockout Kings', position: 10, weight: 0.5 }
];
```

## Run Draft Lottery App

* Open a browser
* Go to where you clone the project on your location machine `file:///Users/{username}/github/ggl-project/draft-lottery-app/draft.html`
* Click `Start Draft` Button