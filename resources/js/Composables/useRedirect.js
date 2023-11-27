
const doRedirect = (path) => window.location.href = path;
export default {
    navbar: (route) => doRedirect(`/${route}`),
    searchLine: () => doRedirect('/search-lines'),
    line: (id) => doRedirect(`/lines/${id}`),
    vehicle: (id) => doRedirect(`/vehicles/${id}`),
    report: (id) => doRedirect(`/reports/${id}`),
    editVehicle: (id) => doRedirect(`/edit-vehicles/${id}`),
    editUser: (id) => doRedirect(`/users/${id}/edit`),
}
