# UF GraphQL API Sprinkle

## \*\*\*NOT SUITABLE FOR PRODUCTION\*\*\*

This sprinkle adds a GraphQL HTTP API to Userfrosting.  The [GraphQL Sprinkle](https://github.com/abdullahseba/uf-graphql) is required for this sprinkle to work.  This is sprinkle is intended to demonstrate how GraphQL could be implemented in Userforsting.  It is not suitable for production use.

### Browsing the API

The most convenient way to browse the API is by using the [GraphiQL](https://chrome.google.com/webstore/detail/chromeiql/fkkiamalmpiidkljmicmjfbieiclmeij) Chrome plugin.  Expand the 'docs' sidebar on the left-hand side to browse available types and queries.

Currently, only the following quires and mutation are available:
 **Quries:**

* `user`
* `users`
* `role`
* `roles`

 **Mutations:**

* `login`
* `logout`

### Installation

Add to your sprinkle directory and rename to `graph_ql_api`.