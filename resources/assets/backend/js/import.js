new Sortable(document.getElementById("sortLeft"), {
    group: 'shared', // set both lists to same group
    animation: 150
});

new Sortable(document.getElementById("sortRight"), {
    group: 'shared',
    animation: 150
});