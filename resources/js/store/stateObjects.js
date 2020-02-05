var tasks = {
    columns: ['manage', 'location', 'slots', 'priority', 'description'],
    search: "",
    sort: { field: 'start_at', direction: 'asc' },
    page: { items: 10, index: 1 },
    priorities: [1, 2, 3],
    day: new Date(),
}

var assignments = {
    columns: ['start_at', 'end_at', 'hours', 'name', 'location', 'description', 'slots', 'priority', 'bids', 'assignments'],
    search: "",
    sort: { field: 'start_at', direction: 'asc' },
    page: { items: 10, index: 1 },
    day: new Date(),
}

var svs = {
    search: "",
    page: { items: 10, index: 1 },
}

var navigation = {
    conferenceTab: 0,
    profileTab: 0,
    lastConference: null,
}

export { tasks, assignments, svs, navigation }