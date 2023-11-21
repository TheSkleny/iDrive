type Shift = {
    LinkId: string,
    LineName: string,
    LineId: string,
    VehicleIcon: string,
    VehicleName: string,
    VehicleId: string,
    FirstStopName: string,
    DepartureDate: string,
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

// type VehicleType = {
//     VehicleTypeId: string,
//     VehicleTypeDescription: string,
//     VehicleTypeIcon: string
// }

type Vehicle = {
    VehicleId: string,
    VehicleName: string,
    VehicleBrand: string,
    VehicleImageUri: string,
    VehicleLastMaintenance: string,
    VehicleCapacity: number,
    VehicleSpeedLimit: number,
    VehicleLicensePlate: string,
    VehicleTypeDescription: string,
    VehicleTypeIcon: string,
    VehicleStateDescription: string
}

