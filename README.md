- can see public REFs	DONE
        REFs = REF content + tags + text summary	
        + id (Link to public profile) of REF creator    	DONE
	
- can see list of tags	DONE
	
- can see list of 'lecturer' published BIBs	DONE
	
- can see list of proposed new tags	DONE
- up/down vote list of proposed new tags (anonymous users votes count as 1 vote)	DONE
- can propose new candidate tag	DONE
	
- can submit suggestions for new REF (goes into 'pending' list for site moderators to accept / reject)	yes
        REF content + tags + text summary	DONE
        	
- can add REFs to 'shopping basket reference list' (a BIB)	yes
        - can change ORDER of items in BIB	DONE
        	
- can export BIB as a List of References Text File	
        - style 1 - Harvard	DONE
        - style 2 - [1], [2], sequence	NOT DONE
        	
- export as JSON (Advanced feature)	
        (suitable for Pandoc citations and references ...)	NOT DONE
        	
-------	
Use cases	
role 'student'	
-------	
	
- can view / search REFs in collections	DONE
        +/- own collections	DONE
        +/- shared collections from other users	DONE
        +/- all public NURLs	DONE
	
can search by:	
        - matching one or more tags	DONE
        - free text content search	DONE
        - by date range (created / last edit)	DONE
        	
- can CRUD personal tags	DONE
	
- can CRUD own REFs and collections and tags	DONE
	
- up/down vote list of proposed new tags (registered users votes count as 5 votes)	
	
- can SAVE a BIB	
        - can CRUD BIBs	DONE
        - can share a BIB with other users 	DONE
	
- can update profile	
        EXTRA marks - upload of profile picture	DONE
        - can make profile public / private (user name is always public for public NURLs)	DONE
        	
        	
-------	
Use cases	
role 'lecturer'	
-------	
- all features of 'student'	
- can publish a BIBS to be public, with a text title and text summary	DONE
	
-------	
Use cases	
role 'admin'	
-------	
- can CRUD student and lecturer and admin accounts	DONE
	
	
-------	
AJAX feature - REF and BIB searchers	
-------	
you are to demonstrate the use of PHP generating JSON to be requested and received by an AJAX script	
The feature to illustrate the use of AJAX is as follows:	
- search criteria (so new criteria are used to make an AJAX request and then re-populate the data on screen)	NOT DONE
        e.g. search by tag / author / free text / clear all search criteria	
