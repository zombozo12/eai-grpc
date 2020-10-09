const grpc = require('grpc')
const proto = grpc.load('proto/work_leave.proto')

const client = new proto.work_leave.EmployeeLeaveDaysService('127.0.0.1:50050', grpc.credentials.createInsecure())

const employees = {
    valid: {
        employee_id: 1,
        name: 'Wiguna R',
        accrued_leave_days: 10,
        requested_leave_days: 4
    },
    ineligible: {
        employee_id: 1,
        name: 'Wiguna R',
        accrued_leave_days: 10,
        requested_leave_days: 20
    },
    invalid: {
        employee_id: 1,
        name: 'Wiguna R',
        accrued_leave_days: 10,
        requested_leave_days: -1
    },
    illegal: {
        foo: 'bar'
    }
}

client.eligibleForLeave(employees.valid, (error, response) => {
    if(!error){
        if(response.eligible){
            client.grantLeave(employees.valid, (error, response) => {
                console.log(response)
            })
        }else{
            console.log('You are currently ineligible for leave days')
        }
    }else{
        console.log(error)
    }
})