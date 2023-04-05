
# Ticket Service (Design)

### Source Controll 
in this service i used git and git flow 
each feature developed in thier own feature branch
and at the end of feature it's merged with develop

i used realese branch to make diffrent version, for ready for realase


### Migration
for each feature, i make migrate for each table 

### Seeding
for presentation purpose i tried to put data randomly for weekly plan , trips , reserve.

### Testing 
i tried to write feature and unit test for each situation


### Repository Design Pattern
data layer of the application is Extracted in Repository folder , business logic dont know how data retrives.


### Command
you can run manully run  a command for cancle reservation

### Schedule 
after you run command for schedule , every minute run a command to check if ther is any reserved passed or not.
if there is a passed reserve it's free that seats, so that other people can take that seats.
