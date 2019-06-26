# Sierra-StaffTools
Collection of Tools for Sierra ILS Libraries

This is the start of a collecion of staff tools for Sierra ILS Libraries.  The heart of this repo is the functions file where i'm building all the code to make the magic happen.  The first commit is a webapp to allow staff to create patrons.  There is a lot of code that is specific to our library system and in the future I'll code switches into the config file to be able to strip those out.  An example is we want to know what polling district you are from so I have code to geo-locate your address and if it's in our of our wards, we set it in a PCODE. 

There are a number of other functions available that are not in use it the first WebApp. They are:

1. Validate Patron (check if a PIN matches a barcode)
2. Get Patron Details
3. Find Patron ID by Barcode
4. Get a list of Patron Overdue Items
5. Get Patrons Fines
6. Get Total Fines Owed
7. Get a list of Due Dates for Checked Out Materials
8. Simple Boolean check if patron has overdue material, returns true or false
9. Get Numner of Checked Out Items
10. Get an Item by Checkout ID
11. Get Item Info by Item ID
12. Get all Patron Details
13. Check if Patron is Elegible to Renew (are they within a month of expiration)
14. Boolean check if a patron is expired
15. Update Patron Expiration Date
16. Update Patron Address
17. Get Patron Address
18. Get Patron Street
19. Get Patron City
20. Get Paton Postal Code
21. Get Patron Email Address
22. Get Patron Messages
23. Update Patron Account Messsage
24. Update Patron Email Address
25. Get Patron Codes
26. Get Patron Type
27. Get Patron Notes
28. Email Hash Functions (more on this in a later app)
29. Update Patron Guardian (we have this for kids who register)
30. Many more!
