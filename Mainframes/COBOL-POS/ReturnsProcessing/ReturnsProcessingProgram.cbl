       identification division.
       program-id. ReturnsProcessingProgram
       author. Francis Hackenberger, Sam chard.

       environment division.
       input-output section.
       file-control.

           select input-file assign to '../../../data/returns.dat'
               organization is line sequential.
               
           select report-file assign to 
               '../../../data/returns-report.dat' organization is line
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
           05 ipt-invoice-no                            pic x(9).
           05 ipt-sku-code                              pic x(15).
           
       fd report-file
           data record is returns-data-line.
           
       01 returns-data-line                               pic x(120).
       
       01 prt-line.
           05 filler                                    pic x(3)
               value spaces.
           05 prt-transaction-code                      pic x.
           05 filler                                    pic x(8)
               value spaces.
           05 prt-transaction-amount                    pic z(5)9.99.
           05 filler                                    pic x(8)
               value spaces.
           05 prt-payment-type                          pic xx.
           05 filler                                    pic x(8)
               value spaces.
           05 prt-store-no                              pic xx.
           05 filler                                    pic x(5)
               value spaces.
           05 prt-invoice-no                            pic x(9).
           05 filler                                    pic x(3)
               value spaces.
           05 prt-sku-code                              pic x(15).
           05 filler                                    pic x(2)
               value spaces.
           05 prt-taxes                                 pic z(4)9.99.

       working-storage section.
       01 sw-eof                                       pic x 
           value 'n'.
        01 report-heading-line.
           05 filler                                    pic x(30)
               value spaces.
           05 filler                                    pic x(14)
               value "RETURNS REPORT".
       
       01 headings-line1.
           05 filler                         
           pic x(11)
               value "TRANSACTION".
           05 filler                                    pic x(2)
               value spaces.
           05 filler                                    pic x(11)
               value "TRANSACTION".   
           05 filler                                    pic x(3)
               value spaces.
           05 filler                                    pic x(7)
               value "PAYMENT".
           05 filler                                    pic x(3)
               value spaces.
           05 filler                                    pic x(5)
               value "STORE".
           05 filler                                    pic x(4)
               value spaces.
           05 filler                                    pic x(7)
               value "INVOICE".
           05 filler                                    pic x(8)
               value spaces.
           05 filler                                    pic x(8)
               value "SKU CODE".
           05 filler                                    pic x(10)
               value spaces.
           05 filler                                    pic x(3)
               value "TAX".
               
       01 headings-line2.
           05 filler                                    pic x(2)
               value spaces.
           05 filler                                    pic x(4)
               value "CODE".
           05 filler                                    pic x(9)
               value spaces.
           05 filler                                    pic x(6)
               value "AMOUNT".  
           05 filler                                    pic x(7)
               value spaces.
           05 filler                                    pic x(4)
               value "TYPE".
           05 filler                                    pic x(5)
               value spaces.
           05 filler                                    pic x(6)
               value "NUMBER".
           05 filler                                    pic x(4)
               value spaces.
           05 filler                                    pic x(6)
               value "NUMBER".
           05 filler                                    pic x(6)
               value spaces.
       
       01 ws-constants.
           05 ws-tax-rate                               pic v999
               value 0.13.
       
       01 ws-transaction-amount                         pic 9(6)v99.
       01 ws-tax-owed                                   pic 9(6)v99.
       
       01 ws-counts-and-totals.
           05 ws-returns-records-count                  pic 9999
               value 0.
           05 ws-returns-total-amount                   pic 9(6)v99.
           05 ws-total-tax-owed                         pic 9(6)v99.
           05 ws-page-count                            pic 99
               value 1.
           05 ws-line-count                            pic 99
               value 0.
           05 ws-lines-per-page                        pic 99
               value 20.
               
       01 prt-page-number-line.
           05 filler                                   pic x(6)
               value "Page #".
           05 prt-page-count                           pic zz9
               value 1.
       
       01 totals-line1.
           05 filler                                    pic x(23)
               value "Total Returns Records:".
           05 filler                                    pic x(2)
               value spaces.
           05 prt-total-returns-count                   pic z(4).
           05 filler                                    pic x(3)
               value spaces.
           05 filler                                    pic x(13)
               value "Total Amount:".
           05 filler                                    pic x(2)
               value spaces.
           05 prt-total-returns-amount                  pic zzz,zz9.99.
           
       01 totals-line2.
           05 filler                                    pic x(16)
               value "Total Tax owed:".
           05 filler                                    pic x(9)
               value spaces.
           05 prt-total-tax-owed                        pic zzz,zz9.99.
       
       procedure division.

           *> Open files
           open input input-file,
               output report-file.
               
           write prt-line from report-heading-line.
           *> Perform Print Heading
           perform 50-print-headings.
           
           *> Perform Validation
           perform 100-process-lines.
           
           *> Perform print
           perform 200-totals.
           
           accept return-code.
           
           *> close files
           close input-file, report-file.
           
           goback.
           

       50-print-headings.
           write prt-line from prt-page-number-line after 
               advancing page.
           write prt-line from headings-line1 after advancing 2 lines.
           write prt-line from headings-line2.
       
       100-process-lines.
       
           read input-file at end move "Y" to sw-eof.
           perform until sw-eof = "Y"
           
           if ws-line-count = ws-lines-per-page
                   add 1 to ws-page-count
                   move ws-page-count to prt-page-count
                   perform 50-print-headings
                   move 0 to ws-line-count
           end-if
               
           add 1 to ws-line-count
           
           move spaces to prt-line
           move ipt-transaction-amount to ws-transaction-amount
           
           compute ws-tax-owed rounded =
                   (ws-transaction-amount * ws-tax-rate)
           add ws-tax-owed to ws-total-tax-owed
           add ws-transaction-amount to ws-returns-total-amount
           add 1 to ws-returns-records-count
           
           move ipt-transaction-code to prt-transaction-code
           move ipt-transaction-amount to prt-transaction-amount
           move ipt-payment-type to prt-payment-type
           move ipt-store-no to prt-store-no
           move ipt-invoice-no to prt-invoice-no
           move ipt-sku-code to prt-sku-code
           move ws-tax-owed to prt-taxes
           
           
           write prt-line from returns-data-line after advancing 1 line
           
           
           read input-file at end move "Y" to sw-eof
           end-perform.
       
       200-totals.
           move ws-returns-records-count to prt-total-returns-count.
           move ws-returns-total-amount to prt-total-returns-amount.
           move ws-total-tax-owed to prt-total-tax-owed.
           
           write prt-line from totals-line1 after advancing 2 lines.
           write prt-line from totals-line2
       
       end program ReturnsProcessingProgram.
       
       