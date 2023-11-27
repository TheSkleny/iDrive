
const doRedirect = (path) => window.location.href = path;
export default {
    navbar: (route) => doRedirect(`/${route}`),
    searchLine: () => doRedirect('/search-lines'),
    line: (id) => doRedirect(`/lines/${id}`),
    vehicle: (id) => doRedirect(`/vehicles/${id}`),
    report: (id) => doRedirect(`/reports/${id}`),
    editVehicle: (id) => doRedirect(`/vehicles/${id}/edit`),
    edituser: (id) => doRedirect(`/users/${id}/edit`),
}
