import { Server } from '@brtmvdl/backend'

const server = new Server()

server.get('/', (_, res) => res.setJSON({}))

server.post('/', (_, res) => res.setJSON({}))

server.listen('80')
