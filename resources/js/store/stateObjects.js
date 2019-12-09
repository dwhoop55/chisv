var tasks = {
    columns: ['manage', 'location', 'slots', 'priority', 'description'],
    search: "",
    sort: { field: 'start_at', direction: 'asc' },
    page: { items: 10, index: 1 },
    priorities: [1, 2, 3],
    day: new Date(),
}

var assignments = {
    columns: ['priority', 'slots'],
    search: "",
    sort: { field: 'start_at', direction: 'asc' },
    page: { items: 10, index: 1 },
    day: new Date(),
}

var svs = {
    search: "",
}

var navigation = {
    conferenceTab: 0,
}

export { tasks, assignments, svs, navigation }