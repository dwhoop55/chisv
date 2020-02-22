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

var report = {
    data: null,
    columns: null,
    updated: null,
    selected: null,
    page: { items: 10, index: 1, paginated: false },
}

var navigation = {
    conferenceTab: 0,
    profileTab: 0,
    lastConference: null,
}

var userIndex = {
    data: null,
    search: "",
    university: null,
    sort: { field: 'firstname', direction: 'asc' },
    page: { items: 25, index: 1 },
}

export { tasks, assignments, svs, report, userIndex, navigation }