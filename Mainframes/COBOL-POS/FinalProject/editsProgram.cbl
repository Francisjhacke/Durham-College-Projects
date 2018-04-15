       identification division.
       program-id. editsProgram.
       author. Francis Hackenberger, Sam Chard.

       environment division.
       input-output section.
       file-control.

           select input-file assign to '../../../data/project1.dat'
               organization is line sequential.
               
           select valid-data-file assign to 
               '../../../data/valid-data.dat' organization is line
               sequential.
               
           select invalid-data-file assign to 
               '../../../data/invalid-data.out' organization is line
               sequential.
               
           select error-log-file assign to 
               '../../../data/error-log.out' organization is line
               sequential.

       data division.
       file section.
       
       fd input-file 
           data record is ipt-record.
           
       01 ipt-record.
           05 ipt-transaction-code                      pic x.
           05 ipt-transaction-amount                    pic 9(5)v99.
           05 ipt-payment-type                          pic xx.
           05 ipt-store-no                              pic xx.
           05 ipt-invoice-no.
               10 ipt-inv-pt-1                          pic xx.
               10 ipt-inv-pt-2                          pic x.
               10 ipt-inv-pt-3                          pic 9(6).
           05 ipt-sku-code                              pic x(15).
           
       fd valid-data-file
           data record is prt-valid-line.
           
       01 valid-data-line                               pic x(120).
           
       01 prt-valid-line.
           05 prt-transaction-code                      pic x.
           05 prt-transaction-amount                    pic 9(5)v99.
           05 prt-payment-type                          pic xx.
           05 prt-store-no                              pic xx.
           05 prt-invoice-no                            pic x(9).
           05 prt-sku-code                              pic x(15).
       
       fd invalid-data-file
           data record is prt-invalid-line.
           
       01 invalid-data-line                             pic x(120).
           
       01 prt-invalid-line.
           05 prt-i-transaction-code                    pic x.
           05 prt-i-transaction-amount                  pic 9(5)v99.
           05 prt-i-payment-type                        pic xx.
           05 prt-i-store-no                            pic xx.
           05 prt-i-invoice-no                          pic x(9).
           05 prt-i-sku-code                            pic x(15).
           
       fd error-log-file
           data record is prt-error-line.
           
       01 prt-error-line                                pic x(120).
       
       working-storage section.
       
       01 ws-error-log-line.
           05 filler                                   pic x(5)
               value spaces.
           05 ws-transaction-code                      pic x.
           05 filler                                   pic x(11)
               value spaces.
           05 ws-transaction-amount                    pic 9(5)v99.
           05 filler                                   pic x(8)
               value spaces.
           05 ws-payment-type                          pic xx.
           05 filler                                   pic x(9)
               value spaces.
           05 ws-store-no                              pic xx.
           05 filler                                   pic x(6)
               value spaces.
           05 ws-invoice-no                            pic x(9).
           05 filler                                   pic x(4)
               value spaces.
           05 ws-sku-code                              pic x(15).  
           
       01 ws-headings1.
           05 filler                                   pic x(11)
               value "Transaction".
           05 filler                                   pic x(5)
               value spaces.
           05 filler                                   pic x(11)
               value "Transaction".
           05 filler                                   pic x(3)
               value spaces.
           05 filler                                   pic x(7)
               value "Payment".
           05 filler                                   pic x(5)
               value spaces.
           05 filler                                   pic x(5)
               value "Store".
           05 filler                                   pic x(5)
               value spaces.
           05 filler                                   pic x(7)
               value "Invoice".
           05 filler                                   pic x(7)
               value spaces.
           05 filler                                   pic x(3)
               value "SKU".                                                                                                                    
       
       01 ws-headings2.
           05 filler                                   pic x(3)
               value spaces.
           05 filler                                   pic x(4)
               value "Code".
           05 filler                                   pic x(10)
               value spaces.
           05 filler                                   pic x(6)
               value "Amount".
           05 filler                                   pic x(8)
               value spaces.
           05 filler                                   pic x(4)
               value "Type".
           05 filler                                   pic x(8)
               value spaces.
           05 filler                                   pic x(2)
               value "NO".
           05 filler                                   pic x(9)
               value spaces.
           05 filler                                   pic x(2)
               value "NO".
           05 filler                                   pic x(10)
               value spaces.
           05 filler                                   pic x(4)
               value "CODE".  
               
       01 sw-eof                                       pic x 
           value 'n'.
           
       01 ws-error-occurred                            pic x
           value 'f'.
           
       01 ws-errors.
           05 ws-error-record                          pic x(100).
           05 ws-tra-code-error.
               10 filler                               pic x(20)
                   value spaces.
               10 filler                               pic xx
                   value "**".
               10 ws-bad-code                          pic x.
               10 filler                               pic x(30)
                   value " - Invalid transacation code**".
           05 ws-tra-amount-error.
               10 filler                               pic x(20)
                   value spaces.
               10 filler                               pic xx
                   value "**".
               10 ws-bad-amount                        pic 9(5)v99.
               10 filler                               pic x(31)
                   value " - Invalid transaction amount**".
           05 ws-pay-type-error.
               10 filler                               pic x(20)
                   value spaces.
               10 filler                               pic xx
                   value "**".
               10 ws-bad-type                          pic xx.
               10 filler                               pic x(25)
                   value " - Invalid payment type**".
           05 ws-store-no-error.
               10 filler                               pic x(27)
                   value spaces.
               10 filler                               pic xx
                   value "**".
               10 ws-bad-store-no                      pic xx.
               10 filler                               pic x(25)
                   value " - Invalid store number**".
           05 ws-invoice-no-error.
               10 filler                               pic x(20)
                   value spaces.
               10 filler                               pic xx
                   value "**".
               10 ws-bad-invoice-no                    pic x(10).
               10 filler                               pic x(27)
                   value " - Invalid invoice number**".
           05 ws-sku-code-error.
               10 filler                               pic x(29)
                   value spaces.
               10 filler                               pic xx
                   value "**".
               10 filler                               pic x(18)
                   value "Invalid sku code**".
           05 ws-bad-sku-code                          pic x.
           
       01 ws-counters.
           05 ws-good-record-count                     pic 999
               value 0.
           05 ws-bad-record-count                      pic 999
               value 0.
               
       01 ws-totals-output.
           05 filler                                   pic x(19)
               value "Good records total:".
           05 filler                                   pic x(3)
               value spaces.
           05 ws-good-record-total                     pic zz9.
           05 filler                                   pic x(10)
               value spaces.
           05 filler                                   pic x(18)
               value "Bad records total:".
           05 filler                                   pic x(3)
               value spaces.
           05 ws-bad-record-total                      pic zz9.

       procedure division.
       
           *> open files
           open input input-file,
               output valid-data-file, invalid-data-file, 
                   error-log-file
           
           *> Perform Print Heading
           perform 50-print-headings.
           
           *> Perform Validation
           perform 100-validation.
           
           *> Perform print
           perform 200-totals.
                   
           accept return-code.
           
           *> close files
           close input-file, valid-data-file, invalid-data-file, 
               error-log-file

           goback.
        
       50-print-headings.
           write prt-error-line from ws-headings1.
           write prt-error-line from ws-headings2.
       
       100-validation.
       
           read input-file at end move "Y" to sw-eof.
           perform until sw-eof = "Y"
      
               *> Moves spaces
               move spaces to prt-valid-line
               move spaces to prt-invalid-line
               move spaces to prt-error-line
               move spaces to invalid-data-line
               move spaces to valid-data-line
               
               move 0 to ws-bad-amount
               move spaces to ws-bad-code
               move spaces to ws-bad-store-no
               move spaces to ws-bad-type
               move spaces to ws-bad-invoice-no
               move spaces to ws-bad-sku-code
               move 'f' to ws-error-occurred
               
               
               *> Validation
               
               *> Validate transaction code
               if (ipt-transaction-code = "S" or ipt-transaction-code =
                   "R" or ipt-transaction-code = "L") then
                   move ipt-transaction-code to prt-transaction-code
               else
                   move ipt-transaction-code to ws-bad-code
                   move 't' to ws-error-occurred
               end-if
               
               *> Validate Transaction Amount
               if (ipt-transaction-amount is numeric) then
                   move ipt-transaction-amount to prt-transaction-amount
               else
                   move ipt-transaction-amount to ws-bad-amount
                   move 't' to ws-error-occurred
               end-if
               
               *> Validate Payment Type
               if (ipt-payment-type = "CA" or ipt-payment-type or "CR"
                   or ipt-payment-type = "DB") then
                   move ipt-payment-type to prt-payment-type
               else
                   move ipt-payment-type to ws-bad-type
                   move 't' to ws-error-occurred
               end-if
               
               *> Validate Store Number
               if (ipt-store-no = "01" or ipt-store-no = "02" or 
                   ipt-store-no = "03" or ipt-store-no = "07") then
                   move ipt-store-no to prt-store-no
               else
                   move ipt-store-no to ws-bad-store-no
                   move 't' to ws-error-occurred
               end-if
               
               *> Validate Invoice Number
               if (ipt-inv-pt-1 is alphabetic and 
                   ipt-inv-pt-3 is numeric) then
                   move ipt-invoice-no to prt-invoice-no
               else
                   move ipt-invoice-no to ws-bad-invoice-no
                   move 't' to ws-error-occurred
               end-if
               
               *> Validate SKU Code
               if (ipt-sku-code not = spaces) then
                   move ipt-sku-code to prt-sku-code
               else
                   move 'x' to ws-bad-sku-code
                   move 't' to ws-error-occurred
               end-if
               
               *> Move to ws variables for error log
               move ipt-transaction-code to ws-transaction-code
               move ipt-transaction-amount to ws-transaction-amount
               move ipt-payment-type to ws-payment-type
               move ipt-store-no to ws-store-no
               move ipt-invoice-no to ws-invoice-no
               move ipt-sku-code to ws-sku-code
               
               move ipt-transaction-code to prt-i-transaction-code
               move ipt-transaction-amount to prt-i-transaction-amount
               move ipt-payment-type to prt-i-payment-type
               move ipt-store-no to prt-i-store-no
               move ipt-invoice-no to prt-i-invoice-no
               move ipt-sku-code to prt-i-sku-code
               
               
               
               *> Output errors
               if (ws-error-occurred = 't') then
               
                   add 1 to ws-bad-record-count
                   
                   move ws-error-log-line to prt-error-line
                   move prt-invalid-line to invalid-data-line
                   
                   write prt-error-line after advancing 1 line
                   write invalid-data-line after advancing 1 line
                   
                    *> Print individual errors
                   if (ws-bad-code not = space) then
                       move ws-tra-code-error to prt-error-line
                       write prt-error-line
                   end-if
                   
                   if (ws-bad-amount not = space and 
                       ws-bad-amount not = 0) then
                       move ws-tra-amount-error to prt-error-line
                       write prt-error-line
                   end-if
                   
                   if (ws-bad-type not = spaces) then
                       move ws-pay-type-error to prt-error-line
                       write prt-error-line
                   end-if
                   
                   if (ws-bad-store-no not = spaces) then
                       move ws-store-no-error to prt-error-line
                       write prt-error-line
                   end-if
                   
                   if (ws-bad-invoice-no not = spaces) then
                       move ws-invoice-no-error to prt-error-line
                       write prt-error-line
                   end-if
                   
                   if (ws-bad-sku-code = 'x') then
                       move ws-sku-code-error to prt-error-line
                       write prt-error-line
                   end-if
                   
   
               else
                   add 1 to ws-good-record-count
                   *> Move lines to output
                   move prt-valid-line to valid-data-line
                   write valid-data-line after advancing 1 line
               end-if

           read input-file at end move "Y" to sw-eof
           end-perform.
           
       200-totals.
           move ws-bad-record-count to ws-bad-record-total.
           move ws-good-record-count to ws-good-record-total.
           
           write prt-error-line from ws-totals-output after advancing 2 
           lines.

       end program editsProgram.