
# Ticket Service (Develop)

### Cache System
we have an weekly plan table that modifies rarely. we can use cache to reduce resource usage.

### Database Design
we have to use weekly plan without seprating city and terminal table.
if we use city and terminals, and then use a proxy pattern to cache this data
we can response to request faster.


### Generate trips automaticly
in this service , base on weekly_plan , we can generate trips availbale for users to take tickets.
i suggest that make an schedule weekly to generate trips for next n weeks later.
in this conditions, we have limited data and use less resource


### Notification Service
this system require a way to commiunicate with user, for special condition like travel delay.
and send ticket number to passengers.

