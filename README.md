# spaceDefence
let's code !

#algorithme for the fleet deployment

step 0: INPUT: all fleets with vessels, map
step 1  init the Map: on the first time, the map is empty
step 2  check if the Map has a capacity to deploy all vessels
step 3    for each vaissel on each fleet
    step 4 : separate supports and offensives vessel
    step 5 : check if theses are same number of supports and offensives vessel (it not implemented yet but necessary)
    step 6: while each offensive vessel are not placed
        step 7: choose a place on the map
        step 8: if it's not free return to step 7
        step 9: get all adjacent free place
        step 10: if there is no adjacent place, return to step 7
        step 11: place the offensive vessel on the choosed place
        step 12: place the support vessel on the on of adjacent place
step 4: output map with all fleets charged

1. What is the complexity of your algorithm (in big O notation)?
my algoritm complexity is O(n2)

2. How would you improve your algorithm?
to improve my algorithm, we must add a value on each place  which depends on the degree of risk and availability of the place.
After placing the vessels according to the lowest weighting

3. How would your adapt your algorithm to three dimensions? How would that affect
the complexity?
To adapt my algorithm to tree dimensions, the first dimension is the position X of each vessel, the second the position Y of each vessel and the last ve value of degree of risk and aivalability of the place
for example
put 999 (infinite) if the place is occuped so we can't choose it
add +2 for each adjacent enemy
add -1 for each adjacent offensives friends

we must recalculate the value at each placement of vessel (frienfs or enemy) so the complexity is O(n3)