swagger: '2.0'
info:
    title: 'Libido APIs'
    description: 'App for sex calculations'
    version: 1.0.0
host: <?php echo $_SERVER['HTTP_HOST']; ?>/api/v1
schemes:
    - http
basePath: /
produces:
    - application/json
paths:
    /user/terms-conditions:
        get:
            summary: 'Terms & Conditions'
            responses:
                200:
                    description: 'Terms & Conditions'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -   
                    name: deviceType
                    in: formData
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1

            tags:
                - 'Users APIs'
    /user/privacy-policies:
        get:
            summary: 'Privacy Policies'
            responses:
                200:
                    description: 'Privacy Policies'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -   
                    name: deviceType
                    in: formData
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1

            tags:
                - 'Users APIs'
    /user/sign-up:
        post:
            summary: 'Sign Up'
            responses:
                200:
                    description: 'Sign Up'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -
                    name: email
                    in: formData
                    description: user's email
                    type: string
                    default: 'ashish@gmail.com'
                -
                    name: password
                    in: formData
                    description: user's password
                    type: string
                    default: 'password'
                -
                    name: userType
                    in: formData
                    description: Must be 2 for app user
                    type: integer
                    default: 2
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1

            tags:
                - 'Users APIs'
    /user/login:
        post:
            summary: 'Login'
            responses:
                200:
                    description: 'Login'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -
                    name: email
                    in: formData
                    description: user's email
                    type: string
                    default: 'ashish@gmail.com'
                -
                    name: password
                    in: formData
                    description: user's password
                    type: string
                    default: 'password'
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1

            tags:
                - 'Users APIs'
    /user/forgot-password:
        post:
            summary: 'Forgot Password'
            responses:
                200:
                    description: 'Forgot Password'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -
                    name: email
                    in: formData
                    description: user's email
                    type: string
                    default: 'ashish@gmail.com'
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1

            tags:
                - 'Users APIs'
    /user/reset-password:
        post:
            summary: 'Reset Password'
            responses:
                200:
                    description: 'Reset Password'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -
                    name: userId
                    in: formData
                    description: user's id
                    type: integer
                    default: 1
                -
                    name: password
                    in: formData
                    description: user's password
                    type: string
                    default: 'password'
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1

            tags:
                - 'Users APIs'
    /user/logout:
        get:
            summary: 'Logout'
            responses:
                200:
                    description: 'Logout'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Users APIs'
    /user/profile:
        get:
            summary: 'Profile'
            responses:
                200:
                    description: 'Profile'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Users APIs'
    /user/complete-profile-1:
        post:
            summary: 'Complete Profile 1'
            responses:
                200:
                    description: 'Complete Profile 1'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -
                    name: firstName
                    in: formData
                    description: user's first name
                    type: string
                    default: "AShish"
                -
                    name: lastName
                    in: formData
                    description: user's last name
                    type: string
                    default: "Ginotra"
                -
                    name: image
                    in: formData
                    description: user's image
                    type: file
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Users APIs'
    /user/complete-profile-2:
        post:
            summary: 'Complete Profile 2'
            responses:
                200:
                    description: 'Complete Profile 2'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -
                    name: relationship
                    in: formData
                    description:  1=Its Complecated 2=Married 3=Open Relationship 4=Single 5=Divorced 6=Seprated 7=Widowed 
                    type: integer
                    default: 2
                -
                    name: gender
                    in: formData
                    description:  1=male 2=female 
                    type: integer
                    default: 1
                -
                    name: dob
                    in: formData
                    description: user's dob
                    type: string
                    default: "1988-09-26"
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Users APIs'
    /user/complete-profile-3:
        post:
            summary: 'Complete Profile 3'
            responses:
                200:
                    description: 'Complete Profile 3'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -
                    name: height
                    in: formData
                    description: user's height
                    type: string
                    default: "199"
                -
                    name: weight
                    in: formData
                    description: user's weight
                    type: string
                    default: "99"
                -
                    name: birthControl
                    in: formData
                    description:  0=no 1=yes 
                    type: integer
                    default: 1
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Users APIs'
    /user/update-username:
        post:
            summary: 'Update Username'
            responses:
                200:
                    description: 'Update Username'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -
                    name: username
                    in: formData
                    description: user's username
                    type: string
                    default: "aginotra"
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Users APIs'
    /user/user-details-username:
        post:
            summary: 'Get User Details via username'
            responses:
                200:
                    description: 'Get User Details via username'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -
                    name: username
                    in: formData
                    description: user's username
                    type: string
                    default: "aginotra"
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Users APIs'
    /user/change-password:
        post:
            summary: 'Change Password'
            responses:
                200:
                    description: 'Change Password'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -
                    name: oldPassword
                    in: formData
                    description: user's old password
                    type: string
                    default: "password"
                -
                    name: password
                    in: formData
                    description: user's new password
                    type: string
                    default: "password"
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Users APIs'
    /user/touch-id:
        post:
            summary: 'Touch Id Enabled'
            responses:
                200:
                    description: 'Touch Id Enabled'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -
                    name: touchId
                    in: formData
                    description: user's touchId
                    type: integer
                    default: "1"
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Users APIs'
    /encounter/add-encounter-1:
        post:
            summary: 'Add Encounter 1'
            responses:
                200:
                    description: 'Add Encounter 1'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -
                    name: encounterId
                    in: formData
                    description: encounter id if exist
                    type: integer
                    default: 1
                -
                    name: sessionType
                    in: formData
                    description: 1=>solo,2=>Single,3=>Multiple
                    type: integer
                    default: 1
                -
                    name: date
                    in: formData
                    description: UTC date
                    type: string
                    default: "2018-08-22"
                -
                    name: time
                    in: formData
                    description:  24 hour format time
                    type: sting
                    default: "18:00:00"
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Encounter APIs'
    /encounter/partner-list:
        get:
            summary: 'Partner List'
            responses:
                200:
                    description: 'Partner List'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Encounter APIs'
    /encounter/protection-list:
        get:
            summary: 'Protection List'
            responses:
                200:
                    description: 'Protection List'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Encounter APIs'
    /encounter/toy-list:
        get:
            summary: 'Toy List'
            responses:
                200:
                    description: 'Toy List'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Encounter APIs'
    /encounter/room-list:
        get:
            summary: 'Room List'
            responses:
                200:
                    description: 'Room List'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Encounter APIs'
    /encounter/position-list:
        get:
            summary: 'Position List'
            responses:
                200:
                    description: 'Position List'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Encounter APIs'
    /encounter/filter:
        get:
            summary: 'Filter List'
            responses:
                200:
                    description: 'Filter List'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Encounter APIs'
    /encounter/encounter-list?limit=10&offset=0:
        get:
            summary: 'Encounter List'
            responses:
                200:
                    description: 'Encounter List'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Encounter APIs'
    /encounter/single-encounter/1:
        get:
            summary: 'Encounter List by id'
            responses:
                200:
                    description: 'Encounter List by id'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Encounter APIs'
    /encounter/add-partner:
        post:
            summary: 'Add Partner'
            responses:
                200:
                    description: 'Add Partner'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -
                    name: name
                    in: formData
                    description: user's name
                    type: string
                    default: "Sarah"
                -
                    name: age
                    in: formData
                    description: user's age
                    type: integer
                    default: 30
                -
                    name: gender
                    in: formData
                    description: 1=>male,2=>female
                    type: integer
                    default: 2
                -
                    name: image
                    in: formData
                    description: user's image
                    type: file
                -
                    name: mappedUserId
                    in: formData
                    description: if already exist user then its userid
                    type: integer
                    default: 11
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Encounter APIs'
    /encounter/add-room:
        post:
            summary: 'Add Room'
            responses:
                200:
                    description: 'Add Room'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -
                    name: name
                    in: formData
                    description: user's room name
                    type: string
                    default: "Sarah"
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Encounter APIs'
    /encounter/add-position:
        post:
            summary: 'Add Position'
            responses:
                200:
                    description: 'Add Position'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -
                    name: name
                    in: formData
                    description: user's room name
                    type: string
                    default: "Sarah"
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Encounter APIs'
    /encounter/add-encounter-2:
        post:
            summary: 'Add Encounter 2'
            responses:
                200:
                    description: 'Add Encounter 2'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -
                    name: encounterId
                    in: formData
                    description: user's encounterId
                    type: integer
                    default: 1
                -
                    name: partner[1]
                    in: formData
                    description: partner key will be partner_id & its value will be is_initiated(0=>No,1=>yes)
                    type: integer
                    default: 0
                -
                    name: partner[4]
                    in: formData
                    description: partner key will be partner_id & its value will be is_initiated(0=>No,1=>yes)
                    type: integer
                    default: 1
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Encounter APIs'
    /encounter/add-encounter-3:
        post:
            summary: 'Add Encounter 3'
            responses:
                200:
                    description: 'Add Encounter 3'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -
                    name: encounterId
                    in: formData
                    description: user's encounterId
                    type: integer
                    default: 1
                -
                    name: isProtectionUsed
                    in: formData
                    description: 0=>no,1=>yes
                    type: integer
                    default: 1
                -
                    name: condoms[0]
                    in: formData
                    description: condoms array with id
                    type: integer
                    default: 1
                -
                    name: condoms[1]
                    in: formData
                    description: condoms array with id
                    type: integer
                    default: 2
                -
                    name: partners[0]
                    in: formData
                    description: partners array who used condoms
                    type: integer
                    default: 1
                -
                    name: partner[1]
                    in: formData
                    description: partners array who used condoms
                    type: integer
                    default: 2
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Encounter APIs'
    /encounter/add-encounter-4:
        post:
            summary: 'Add Encounter 4'
            responses:
                200:
                    description: 'Add Encounter 4'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -
                    name: encounterId
                    in: formData
                    description: user's encounterId
                    type: integer
                    default: 1
                -
                    name: isToyUsed
                    in: formData
                    description: 0=>no,1=>yes
                    type: integer
                    default: 1
                -
                    name: isIntercourse
                    in: formData
                    description: 0=>no,1=>yes
                    type: integer
                    default: 1
                -
                    name: isIntoxicantUsed
                    in: formData
                    description: 0=>no,1=>yes
                    type: integer
                    default: 1
                -
                    name: isLubricationUsed
                    in: formData
                    description: 0=>no,1=>yes
                    type: integer
                    default: 1
                -
                    name: toys[0]
                    in: formData
                    description: toys array with id
                    type: integer
                    default: 1
                -
                    name: toys[1]
                    in: formData
                    description: toys array with id
                    type: integer
                    default: 2
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Encounter APIs'
    /encounter/add-encounter-5:
        post:
            summary: 'Add Encounter 5'
            responses:
                200:
                    description: 'Add Encounter 5'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -
                    name: encounterId
                    in: formData
                    description: user's encounterId
                    type: integer
                    default: 1
                -
                    name: rooms[0]
                    in: formData
                    description: rooms array with id
                    type: integer
                    default: 1
                -
                    name: rooms[1]
                    in: formData
                    description: rooms array with id
                    type: integer
                    default: 2
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Encounter APIs'
    /encounter/add-encounter-6:
        post:
            summary: 'Add Encounter 6'
            responses:
                200:
                    description: 'Add Encounter 6'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -
                    name: encounterId
                    in: formData
                    description: user's encounterId
                    type: integer
                    default: 1
                -
                    name: roomId
                    in: formData
                    description: user's room id
                    type: integer
                    default: 1
                -
                    name: howLong
                    in: formData
                    description: how long he spend in minutes
                    type: integer
                    default: 1
                -
                    name: positions[0]
                    in: formData
                    description: positions array with id
                    type: integer
                    default: 1
                -
                    name: positions[1]
                    in: formData
                    description: positions array with id
                    type: integer
                    default: 2
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Encounter APIs'
    /encounter/add-encounter-7:
        post:
            summary: 'Add Encounter 7'
            responses:
                200:
                    description: 'Add Encounter 7'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -
                    name: encounterId
                    in: formData
                    description: user's encounterId
                    type: integer
                    default: 1
                -
                    name: roomId
                    in: formData
                    description: user's room id
                    type: integer
                    default: 1
                -
                    name: orgasam
                    in: formData
                    description: number of user's orgasam
                    type: integer
                    default: 1
                -
                    name: partners[1]
                    in: formData
                    description: in key partner's id & in value its orgasam
                    type: integer
                    default: 1
                -
                    name: partners[2]
                    in: formData
                    description: in key partner's id & in value its orgasam
                    type: integer
                    default: 2
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Encounter APIs'
    /encounter/add-encounter-8:
        post:
            summary: 'Add Encounter 8'
            responses:
                200:
                    description: 'Add Encounter 8'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -
                    name: encounterId
                    in: formData
                    description: user's encounterId
                    type: integer
                    default: 1
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Encounter APIs'
    /encounter/add-long-term:
        post:
            summary: 'Add Long Term'
            responses:
                200:
                    description: 'Add Long Term'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -
                    name: partnerId
                    in: formData
                    description: user's partnerId
                    type: integer
                    default: 1
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Encounter APIs'
    /encounter/remove-long-term:
        post:
            summary: 'Remove Long Term'
            responses:
                200:
                    description: 'Remove Long Term'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -
                    name: partnerId
                    in: formData
                    description: user's partner Id
                    type: integer
                    default: 1
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Encounter APIs'
    /encounter/fav-room:
        post:
            summary: 'Favourite Room'
            responses:
                200:
                    description: 'Favourite Room'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -
                    name: roomId
                    in: formData
                    description: user's room Id
                    type: integer
                    default: 1
                -
                    name: isFavourite
                    in: formData
                    description: user's room Id
                    type: integer
                    default: 1
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Encounter APIs'
    /encounter/fav-position:
        post:
            summary: 'Favourite Position'
            responses:
                200:
                    description: 'Favourite Position'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -
                    name: positionId
                    in: formData
                    description: user's position Id
                    type: integer
                    default: 1
                -
                    name: isFavourite
                    in: formData
                    description: user's room Id
                    type: integer
                    default: 1
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Encounter APIs'
    /encounter/delete-encounter:
        delete:
            summary: 'Delete Encounter'
            responses:
                200:
                    description: 'Delete Encounter'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -
                    name: encounterId
                    in: formData
                    description: user's encounterId
                    type: integer
                    default: 1
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Encounter APIs'
    /encounter/delete-partner-flow:
        delete:
            summary: 'Delete Partner Flow'
            responses:
                200:
                    description: 'Delete Partner Flow'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -
                    name: encounterId
                    in: formData
                    description: user's encounterId
                    type: integer
                    default: 1
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Encounter APIs'
    /encounter/delete-room:
        delete:
            summary: 'Delete Room'
            responses:
                200:
                    description: 'Delete Room'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -
                    name: encounterId
                    in: formData
                    description: user's encounterId
                    type: integer
                    default: 1
                -
                    name: roomId
                    in: formData
                    description: user's roomId
                    type: integer
                    default: 1
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Encounter APIs'
    /encounter/remove-partner:
        delete:
            summary: 'Remove Partner'
            responses:
                200:
                    description: 'Remove Partner'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -
                    name: partnerId
                    in: formData
                    description: user's partnerId
                    type: integer
                    default: 1
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Encounter APIs'
    /report/total-record:
        get:
            summary: 'Report Api'
            responses:
                200:
                    description: 'Report Api'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Report APIs'
    /report/total-stats:
        get:
            summary: 'Report Api'
            responses:
                200:
                    description: 'Report Api'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Report APIs'
    /report/achievement:
        get:
            summary: 'achievement count'
            responses:
                200:
                    description: 'achievement count'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Report APIs'
    /report/streak:
        post:
            summary: 'Report Streak'
            responses:
                200:
                    description: 'Report Streak'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -
                    name: key
                    in: formData
                    description: week, month, daily, quarter, year
                    type: string
                    default: "month"
                -
                    name: partnerId
                    in: formData
                    description: partner id
                    type: integer
                    default: 1
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Report APIs'
    /report/average:
        post:
            summary: 'Average'
            responses:
                200:
                    description: 'Average'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -
                    name: key
                    in: formData
                    description: week, month, daily, quarter, year
                    type: string
                    default: "month"
                -
                    name: partnerId
                    in: formData
                    description: partner id
                    type: integer
                    default: 1
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Report APIs'
    /report/favourite:
        post:
            summary: 'Favourite'
            responses:
                200:
                    description: 'Favourite'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -
                    name: key
                    in: formData
                    description: week, month, daily, quarter, year
                    type: string
                    default: "month"
                -
                    name: partnerId
                    in: formData
                    description: partner id
                    type: integer
                    default: 1
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Report APIs'
    /report/session:
        post:
            summary: 'Session'
            responses:
                200:
                    description: 'Session'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -
                    name: key
                    in: formData
                    description: week, month, daily, quarter, year
                    type: string
                    default: "month"
                -
                    name: partnerId
                    in: formData
                    description: partner id
                    type: integer
                    default: 1
                -
                    name: positionId
                    in: formData
                    description: position id
                    type: integer
                    default: 1
                -
                    name: roomId
                    in: formData
                    description: room id
                    type: integer
                    default: 1
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Report APIs'
    /report/day-since:
        post:
            summary: 'Day Since'
            responses:
                200:
                    description: 'Day Since'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -
                    name: partnerId
                    in: formData
                    description: partner id
                    type: integer
                    default: 1
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Report APIs'
    /survey/survey-list: 
        get:
            summary: 'List of Surveys'
            responses:
                200:
                    description: 'List of Surveys'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Survey APIs'
                
    /survey/question:
        get:
            summary: 'Question List'
            responses:
                200:
                    description: 'Question List'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Survey APIs'
    /survey/answer:
        post:
            summary: 'Question List'
            responses:
                200:
                    description: 'Question List'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -   
                    name: questionId
                    in: formData
                    description: question Id
                    type: integer
                    default: 1
                -   
                    name: answer
                    in: formData
                    description:  1=intersted 2=intersted if partner is 3=not intersted 
                    type: integer
                    default: 1
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Survey APIs'
    /survey/matching-report:
        post:
            summary: 'Matching Report'
            responses:
                200:
                    description: 'Matching Report'
                default:
                    description: ""
                    schema:
                        type: json
                        $ref: '#/definitions/Error'
            consumes:
                - application/json
            parameters:
                -   
                    name: partnerId
                    in: formData
                    description: partner Id
                    type: integer
                    default: 1
                -   
                    name: deviceType
                    in: header
                    description: 1 for ios & 2 for android
                    type: integer
                    default: 1
                -   
                    name: userToken
                    in: header
                    description: User's Access Token
                    type: string
                    default: "abcdefgh"

            tags:
                - 'Survey APIs'


