type Shift = {
    LinkId: string,
    LineName: string,
    LineId: string,
    VehicleIcon: string,
    VehicleName: string,
    FirstStopName: string,
    DepartureTime: string,
    FirstStop: string,
    LastStop: string
}

type Stop = {
    LineStopId: string,
    Order: number,
    Name: string
}

type Line = {
    LineName: string,
    Stops: Stop[]
}

