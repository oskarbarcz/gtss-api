# Relations
This document describes base relations between resources.

## Entities and their properties
- Train
  - id
  - number
  - stops (**Stop**)
  - line (**Line**)
- Operator
  - id
  - name
  - image
  - lines (**Line**)
- Station
  - id
  - shortName
  - fullName
  - lines (**Line**)
  - city (**City**)
- Line
  - id
  - name
  - stations (**Station**)
  - trains (**Train**)
  - operator (**Operator**)
- Stop
  - id
  - scheduledArrivalTime
  - scheduledDepartureTime
  - predictedArrivalTime
  - predictedDepartureTime
  - train (**Train**)
  - station (**Station**Sc)
- City
  - id
  - name
  - stations (**Station**)

# Services
## GTSS - General train, stop, station API
## SG - Schedule generator
## SRM - Seat reservation manager
